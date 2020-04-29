<?php

namespace App\Http\Controllers;

use App\Summary;
use app\Wallet;
use Illuminate\Http\Request;

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

    public function directWithdraw(Request $request) {
        $wallet1 = Wallet::where('user_id', '=', $request->id)->where('wallet_type_id', '=', 1)->first();
        $max_withdraw = $wallet1->max_withdraw;
        if ($max_withdraw != null) {
            $request->validate([
                'wallet1' => "numeric|max:$max_withdraw|min:0"
            ]);
        }

        $wallet1->balance -= $request->wallet1;
        $wallet1->save();

        $wallet1->max_withdraw -= $request->wallet1;
        Summary::create(['user_id'=>$request->id, 'bonus_type_id'=>1, 'balance' => $request->wallet1, 'status'=>'decrement','text'=>"$request->wallet1 after withdraw"]);

        return back();
    }

    public function pairingWithdraw(Request $request) {
        $wallets = Wallet::where('user_id', '=', $request->id)->where('wallet_type_id', '=', 2)->first();
        $request->validate([
            'wallet2' => "numeric|max:$wallets->balance|min:0"
        ]);

        $wallets->balance -= $request->wallet2;
        $wallets->save();
        Summary::create(['user_id'=>$request->id, 'bonus_type_id'=>2, 'balance' => $request->wallet2, 'status'=>'decrement','text'=>"$request->wallet2 after withdraw"]);

        return back();
    }

    public function jackpotWithdraw(Request $request) {
        $wallets = Wallet::where('user_id', '=', $request->id)->where('wallet_type_id', '=', 3)->first();
        $request->validate([
            'wallet3' => "numeric|max:$wallets->balance|min:0"
        ]);

        $wallets->balance -= $request->wallet3;
        $wallets->save();
        Summary::create(['user_id'=>$request->id, 'bonus_type_id'=>2, 'balance' => $request->wallet3, 'status'=>'decrement','text'=>"$request->wallet3 after withdraw"]);

        return back();
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
