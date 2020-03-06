<?php

namespace App\Http\Controllers\Auth;

use App\Account;
use App\Http\Controllers\UserController;
use App\Package;
use App\User;
use App\Summary;
use App\Http\Controllers\Controller;
use App\Wallet;
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
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'referral' => ['required', 'string', 'exists:users,username'],
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
        $referral = User::where('username', '=', $data['referral'])->first();
        $user_id = User::get()->last()->id + 1;
        $uController = new UserController();

        $this->jackpot($referral->id, $user_id, $uController);
        $this->pairing($referral->id);
        $this->direct($data['package'], $referral->id, $user_id);

        //add net wallet
        Wallet::create(['user_id' => $user_id, 'wallet_type_id' => 1, 'balance' => 0]);
        Wallet::create(['user_id' => $user_id, 'wallet_type_id' => 2, 'balance' => 0]);
        Wallet::create(['user_id' => $user_id, 'wallet_type_id' => 3, 'balance' => 0]);

        return User::create([
            'parent_id' => $referral->id,
            'username' => $data['username'],
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => 'member',
            'account_id' => 1,
            'package_id' => $data['package']
        ]);
    }

    public function direct($package, $referral_id, $user_id){
        $balance = Package::find($package)->package_cost;

        $referralWallet = Wallet::where('user_id', '=', $referral_id)->where('wallet_type_id', '=', 1)->first();
        $addBalance = (double)$balance*0.2;
        $referralWallet->balance += (int)$addBalance;
        $referralWallet->save();

        Summary::create(['user_id'=>$referral_id, 'bonus_type_id'=>1, 'status'=>'increment','text'=>"$addBalance from user with id $user_id because of a first registration"]);
    }

    public function pairing($referral_id){
        $bonus = 0;
        $child = User::where('parent_id', '=', $referral_id)->count() + 1;
        if ($child == 20) $bonus = 500;
        else if ($child == 60) $bonus = 1000;
        else if ($child == 160) $bonus = 2000;
        else if ($child == 400) $bonus = 5000;
        else if ($child == 1000) $bonus = 10000;
        else if ($child == 2000000) $bonus = 20000;

        if ($bonus != 0) {
            $referralWallet = Wallet::where('user_id', '=', $referral_id)->where('wallet_type_id', '=', 1)->first();
            $referralWallet->balance += $bonus;
            $referralWallet->save();

            Summary::create(['user_id'=>$referral_id, 'bonus_type_id'=>2, 'status'=>'increment','text'=>"$bonus because you have got $child members!"]);
        }
    }

    public function jackpot($referral_id, $user_id, $uController){
        $referralWallet = Wallet::where('user_id', '=', $referral_id)->where('wallet_type_id', '=', 3)->first();
        $referralWallet->balance += 30;
        $referralWallet->save();

        Summary::create(['user_id'=>$referral_id, 'bonus_type_id'=>3, 'status'=>'increment','text'=>"30 from user with id $user_id because of a first registration"]);

        $uController->checkStatusJackpot($referral_id);
    }

    public function showRegistrationForm()
    {
        $packages = Package::all();
        return view('auth.register', compact(['packages', $packages]));
    }
}
