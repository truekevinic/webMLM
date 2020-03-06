@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form class="card" method="post">
                    <div class="card-header"><p>Your Wallet</p></div>
                    <div class="card-body">
                        @foreach($wallets as $w)
                            <div class="child-member">
                                <div class="card-body">
                                    <input type="number" name="wallet{{$w->wallet_type_id}}" id="wallet{{$w->wallet_type_id}}" max="{{$w->balance}}" min="0" value="0">
                                    {{'Bonus '.$w->walletTypes.'    '.$w->balance}}
                                </div>
                            </div>
                        @endforeach
                    </div>
{{--                    <div>Total {{$_POST["wallet1"]+$_POST["wallet2"]+$_POST["wallet3"]}}</div>--}}
                    <input type="submit" value="Withdraw">
                </form>
            </div>
        </div>
    </div>
@endsection
