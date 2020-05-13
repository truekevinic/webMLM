<?php

namespace App\Http\Controllers;

use App\Account;
use App\ActivationPoint;
use App\BankPoint;
use App\McdPoint;
use App\Package;
use App\Pairing;
use App\RegistrationPoint;
use App\Rules\PointRule;
use App\Summary;
use App\User;
use App\Wallet;
use App\WithdrawAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function jackpotView(int $id){
        $bonus = Wallet::where('user_id', '=', $id)->where('wallet_type_id', '=', 3)->first();
        $summaries = Summary::where('user_id','=',$id)->where('bonus_type_id', '=', 3)->get();

        $levelJackpot = Wallet::where('user_id','=',Auth::user()->id)->where('wallet_type_id','=',3)->first()->level;

        $max_jackpot = Account::find($levelJackpot)->max_bonus;

        return view('user.wallet.withdraw', compact(['bonus', $bonus], ['summaries', $summaries], ['max_jackpot', $max_jackpot]))->with('typeStr', 'Jackpot')->with('balance', $bonus->balance)->with('type', 3);
    }

    public function directView($id){
        $bonus = Wallet::where('user_id', '=', $id)->where('wallet_type_id', '=', 1)->first(); //
        $summaries = Summary::where('user_id','=',$id)->where('bonus_type_id', '=', 1)->get(); //
        $packages = Package::where('deleted',0)->get();
        $user_package = Auth::user()->package_id;

        $max_withdraw = $bonus->max_withdraw;
        $balance = $bonus->balance;

        $decrement = ($balance <= $max_withdraw ? $balance : $max_withdraw);
        $max_direct = Wallet::where('user_id','=',Auth::user()->id)->where('wallet_type_id','=',1)->first()->max_withdraw;

        return view('user.wallet.withdraw', compact(['bonus', $bonus], ['summaries', $summaries], ['packages', $packages], ['user_package', $user_package], ['max_direct', $max_direct]))->with('typeStr', 'Direct')->with('balance', $decrement)->with('type', 1)->with('user', Auth::user());
    }

    public function pairingView($id){
        $bonus = Wallet::where('user_id', '=', $id)->where('wallet_type_id', '=', 2)->first();
        $summaries = Summary::where('user_id','=',$id)->where('bonus_type_id', '=', 2)->get();

        $groupSale = $this->myGroupSales($id);

        $levelPairing = Wallet::where('user_id','=',Auth::user()->id)->where('wallet_type_id','=',2)->first()->level;

        $max_pairing = (Pairing::find($levelPairing)->group_deposit)*3;

        return view('user.wallet.withdraw', compact(['bonus', $bonus], ['summaries', $summaries], ['max_pairing', $max_pairing]))->with('group_sale_list', $groupSale['group_sale_list'])->with('total_group_sale', $groupSale['total_group_sale'])
            ->with('typeStr', 'Pairing')->with('balance', $bonus->balance)->with('type', 2);
    }

    public function withdraw(Request $request, $type) { //jackpot oke

        $max_withdraw = null;
        $balance = 0;
        $decrement = 0;

        $wallet = Wallet::where('user_id', '=', Auth::user()->id)->where('wallet_type_id', '=', $type)->first();

        if ((int)$type == 1) {
            $max_withdraw = $wallet->max_withdraw;
            $balance = $wallet->balance;
            $decrement = ($balance <= $max_withdraw ? $balance : $max_withdraw);
        }

        if ($max_withdraw == null) $decrement = $wallet->balance;

        $bank = $request->bank;
        $registration = $request->registration;
        $activation = $request->activation;
        $mcd = $request->mcd;

        $request->validate([
            'wallet' => ['numeric',"digits_between:2,$decrement",new PointRule($bank+$registration+$activation+$mcd)]
        ]);

        $wallet->balance -= $request->wallet;
        if ((int)$type == 1) $wallet->max_withdraw -= $request->wallet;
        $wallet->save();

        $val = $request->wallet - (int)(((int)$request->wallet)*0.8);
        $foundation = BankPoint::where('user_id','=',1)->first();
        $foundation->balance += $val;
        $foundation->save();

        if ($bank > 0)  {
            DB::table('withdraw_accounts')->insert(['user_id' => Auth::user()->id, 'type' => 'bank', 'balance' => $bank]);
            $bankPoint = BankPoint::where('user_id', Auth::user()->id)->first();
            $bankPoint->balance += $bank;
            $bankPoint->save();
        }
        if ($registration > 0)  {
            DB::table('withdraw_accounts')->insert(['user_id' => Auth::user()->id, 'type' => 'registration', 'balance' => $registration]);
            $registrationPoint = RegistrationPoint::where('user_id', Auth::user()->id)->first();
            $registrationPoint->balance += $registration;
            $registrationPoint->save();
        }
        if ($activation > 0)  {
            DB::table('withdraw_accounts')->insert(['user_id' => Auth::user()->id, 'type' => 'activation', 'balance' => $activation]);
            $activationPoint = ActivationPoint::where('user_id', Auth::user()->id)->first();
            $activationPoint->balance += $activation;
            $activationPoint->save();
        }
        if ($mcd > 0)  {
            DB::table('withdraw_accounts')->insert(['user_id' => Auth::user()->id, 'type' => 'mcd', 'balance' => $mcd]);
            $mcdPoint = McdPoint::where('user_id', Auth::user()->id)->first();
            $mcdPoint->balance += $mcd;
            $mcdPoint->save();
        }

        if ($type == 1) {
            if ($wallet->max_withdraw <= 0) {
                $user = User::find(Auth::user()->id);
                $user->suspend_status = 'suspend';
                $user->save();
            }
        }

        Summary::create(['user_id'=>Auth::user()->id, 'bonus_type_id'=>(int)$type, 'balance' => $request->wallet, 'status'=>'decrement','text'=>"$request->wallet after withdraw"]);

        return back();
    }

    public function directWithdraw(Request $request) {
        $wallet = Wallet::where('user_id', '=', Auth::user()->id)->where('wallet_type_id', '=', 1)->first();
        $max_withdraw = $wallet->max_withdraw;
        $balance = $wallet->balance;

        $decrement = ($balance <= $max_withdraw ? $balance : $max_withdraw);
        if ($max_withdraw != null) {
            $request->validate([
                'wallet' => "numeric|digits_between:2,$decrement"
            ]);
        }

        $wallet->balance -= $request->wallet;
        $wallet->max_withdraw -= $request->wallet;
        $wallet->save();

        $wallet->max_withdraw -= $request->wallet;
        Summary::create(['user_id'=>Auth::user()->id, 'bonus_type_id'=>1, 'balance' => $request->wallet, 'status'=>'decrement','text'=>"$request->wallet after withdraw"]);

        return back();
    }

    public function myGroupSales($id) {
        $members = User::where('parent_1', '=', $id)->get();
        $group_sale_list = [];
        $total_group_sale = 0;

        $wallet = Wallet::where('wallet_type_id', '=', 2)->where('user_id','=',$id)->first();

        foreach($members as $m) {
            $group_sale = (int)DB::table('users')->where('parent_1', '=', $m->id)->join('wallets', 'wallets.user_id', '=', 'users.id')->where('wallet_type_id', '=', 2)->sum('balance');

            $group_content = [
                'user_id' => $m->id,
                'user_name' => $m->name,
                'group_sale' => $group_sale
            ];

            $group_deposit = Pairing::find($wallet->level)->group_deposit;

            array_push($group_sale_list, $group_content);
            $total_group_sale += ($group_sale >= $group_deposit ? $group_deposit : $group_sale);
        }

        return ['group_sale_list' => $group_sale_list, 'total_group_sale' => $total_group_sale];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
