<?php

namespace App\Http\Controllers;

use App\Account;
use App\Advertisement;
use App\BankPoint;
use App\Package;
use App\Pairing;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $donation = BankPoint::where('user_id','=',1)->first()->balance;
        $advertisements = Advertisement::all();

        $max_direct = 0;
        $max_pairing = 0;
        $max_jackpot = 0;

        if (Auth::user()->id != 1) {
            $package = Package::where('id','=',Auth::user()->package_id)->first();
            $max_balance = $package->max_balance;
            $max_withdraw = $package->max_withdraw;

            $max_direct = $max_balance*$max_withdraw;

            $levelPairing = Wallet::where('user_id','=',Auth::user()->id)->where('wallet_type_id','=',2)->first()->level;
            $max_pairing = (Pairing::find($levelPairing)->group_deposit)*3;

            $levelJackpot = Wallet::where('user_id','=',Auth::user()->id)->where('wallet_type_id','=',3)->first()->level;
            $max_jackpot = Account::find($levelJackpot)->max_bonus;
        }

        return view('home', compact(['advertisements', $advertisements]))->with('donation', $donation)->with('max_direct', $max_direct)->with('max_pairing', $max_pairing)->with('max_jackpot', $max_jackpot);
    }

}
