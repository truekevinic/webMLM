<?php

namespace App\Http\Controllers\Auth;

use App\Account;
use App\Http\Controllers\UserController;
use App\Package;
use App\User;
use App\Summary;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'referral' => ['required', 'string', 'exists:users,name'],
            'package' => ['required', 'exists:packages,id']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $uController = new UserController();

        $package = Package::find($data['package'])->package_cost;
        $referral = User::where('name', '=', $data['referral'])->first();

        $balance = $referral->balance;
        $referral->balance += 30;
        $referral->save();

        $user_id = User::get()->last()->id + 1;

        $summary = new Summary();
        $summary->user_id = $referral->id;
        $summary->status = "increment";
        $summary->text = "30 from user with id ".$user_id." because of a first registration";
        $summary->save();
        
        $summary = new Summary();
        $summary->user_id = $user_id;
        $summary->status = "increment";
        $summary->text = ($package*1.2)." from first registration";
        $summary->save();

        $uController->checkStatus($referral->id);

        return User::create([
            'parent_id' => $referral->id,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => 'member',
            'account_id' => 1,
            'package_id' => $data['package'],
            'balance' => $package * 1.2
        ]);
    }

    public function showRegistrationForm()
    {
        $packages = Package::all();
        return view('auth.register', compact(['packages', $packages]));
    }
}
