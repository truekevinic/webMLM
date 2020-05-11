<?php

namespace App\Http\Controllers;

use App\ActivationPoint;
use App\Pin;
use App\PriceList;
use App\RegistrationPoint;
use App\Rules\BuyPinRule;
use App\Rules\PointRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PinController extends Controller
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

    public function buyPinPost(Request $request) {
        $reg = $request->registration;
        $ac = $request->activation;
        $totallBuy = $request['pin-total'];

        $request->validate([
            'pin-total' => ['numeric','min:0',new BuyPinRule($reg, $ac)]
        ]);

        for ($i = 0; $i < $totallBuy; $i++) {
            DB::table('pins')->insert([
                'referral_id' => Auth::user()->id,
                'used_id' => 0,
                'code' => strtoupper(substr(uniqid(),-8)),
                'status' => 'pending'
            ]);
        }

        $registration = RegistrationPoint::where('user_id','=',Auth::user()->id)->first();
        $registration->balance -= $reg;
        $registration->save();

        $activation = ActivationPoint::where('user_id','=',Auth::user()->id)->first();
        $activation->balance -= $ac;
        $activation->save();

        return back();
    }

    public function buyPin() {
        $reg = (int)RegistrationPoint::where('user_id', '=', Auth::user()->id)->sum('balance');
        $ac = (int)ActivationPoint::where('user_id', '=', Auth::user()->id)->sum('balance');

        $pin = Pin::where('referral_id', '=', Auth::user()->id)->get();
        $pinPrice = PriceList::where('name','=','pin')->first()->price;
        return view('user.buy-pin')->with('pin', $pin)->with('reg', $reg)->with('ac', $ac)->with('pinPrice', $pinPrice);
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
     * @param  \App\Pin  $pin
     * @return \Illuminate\Http\Response
     */
    public function show(Pin $pin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pin  $pin
     * @return \Illuminate\Http\Response
     */
    public function edit(Pin $pin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pin  $pin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pin $pin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pin  $pin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pin $pin)
    {
        //
    }
}
