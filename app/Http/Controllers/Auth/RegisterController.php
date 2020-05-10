<?php

namespace App\Http\Controllers\Auth;

use App\Account;
use App\Http\Controllers\UserController;
use App\Package;
use App\Rules\RegisterRule;
use App\User;
use App\Summary;
use App\Http\Controllers\Controller;
use App\Wallet;
use Carbon\Carbon;
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
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'referral_code' => ['required', 'string', 'exists:users', new RegisterRule],
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
        $referral = User::where('referral_code', '=', $data['referral_code'])->first();
        $user_id = User::get()->last()->id + 1;
        $uController = new UserController();

        $package = Package::find($data['package']);
        $max_balance = $package->max_balance;
        $paid_balance = $package->package_cost;
        $max_withdraw = $package->max_withdraw;

//        $childCount = User::where('parent_id','=',$referral->id)->count();

//        $parent_id = null;
        $active_status = 'pending';
        $role_status = 'unapproved';
        $suspend_status = 'unsuspend';

//        if ($childCount < 3) {
//            $parent_id = $referral->id;
//            $active_status = 'active';
//
//            $uController->jackpot($parent_id, $user_id);
//            $uController->checkStatusDirect((double)$paid_balance*0.2, $parent_id, $user_id);
//
//            //add new wallet
//            Wallet::create(['user_id' => $user_id, 'wallet_type_id' => 1, 'balance' => 0, 'max_balance' => $max_balance, 'max_withdraw' => (int)((double)$max_balance*$max_withdraw), 'level' => null]); //direct
//            Wallet::create(['user_id' => $user_id, 'wallet_type_id' => 2, 'balance' => 0, 'max_balance' => 0, 'max_withdraw' => 0, 'level' => 1]); //pairing
//            Wallet::create(['user_id' => $user_id, 'wallet_type_id' => 3, 'balance' => 0, 'max_balance' => 0, 'max_withdraw' => 0, 'level' => 1]); //jackpot
//        }

        $referral_code = substr(str_shuffle($this->generateHashWithSalt($user_id)),0,8);
        $otherUser = User::where('referral_code','=',$referral_code)->count();
        while ($otherUser > 0) {
            $referral_code = substr(str_shuffle(bcrypt($user_id)),0,8);
            $otherUser = User::where('referral_code','=',$referral_code)->count();
        }

        return User::create([
            'referral_id' => $referral->id,
            'username' => $data['username'],
            'parent_id' => null,
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => 'member',
            'account_id' => 1,
            'profile_image' => 'dummy.png',
            'package_id' => $data['package'],
            'active_status' => $active_status,
            'role_status' => $role_status,
            'suspend_status' => $suspend_status,
            'referral_code' => $referral_code,
        ]);
    }

    public function generateHashWithSalt($id) {
        $intermediateSalt = md5(uniqid(rand(), true));
        $salt = substr($intermediateSalt, 0, 8);
        return hash("sha256", $id . $salt);
    }

    public function showRegistrationForm()
    {

        $packages = Package::where('deleted',0)->get();
        return view('auth.register', compact(['packages', $packages]));
    }
}
