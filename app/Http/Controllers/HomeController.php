<?php

namespace App\Http\Controllers;

use App\Advertisement;
use App\BankPoint;
use Illuminate\Http\Request;
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
        return view('home', compact(['advertisements', $advertisements]))->with('donation', $donation);
    }

}
