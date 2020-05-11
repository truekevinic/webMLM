@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="my-5">

                <div class="card">
                    <div class="card-header">
                        <h3>Direct Wallet</h3>
                    </div>
                    <div class="card-body">
                        <div class="child-member">
                            <div class="card-body">{{$bonus->balance}}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-5">

                <div class="card">
                    <div class="card-header">
                        <h3>Summaries</h3>
                    </div>
                    <br>
                    @foreach($summaries as $s)
                    <div class="card-body">
                        {{$s->text}}
                        @if($s->status == "increment")
                        <label style="color: #2a9055; font-weight: bold; font-size: 1.3em;">++</label>
                        @else
                        <label style="color: red; font-weight: bold; font-size: 1.3em;">--</label>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="my-5">

                @if(Auth::user()->name != 'admin')
                <div class="card">
                    <div class="card-header">
                        <h3>Upgrade Package</h3>
                    </div>
                    <div class="card-body">
                        <form action="/wallet/upgrade-package" method="post">
                            {{csrf_field()}}
                            <select name="upgrade_package" id="upgrade_package">
                                @foreach($packages as $p)
                                @if($p->id > $user_package)
                                <option value="{{$p->id}}">
                                    {{'Get Max Withdraw $'.($p->max_withdraw*(double)$p->max_balance).' for $'.$p->package_cost}}
                                </option>
                                @endif
                                @endforeach
                            </select>
                            <button>Upgrade</button>
                        </form>
                    </div>
                </div>
                @endif
            </div>
            <div class="my-5">

                <div class="card">
                    <div class="card-header">
                        <h3>Withdraw</h3>
                    </div>
                    <form action="/wallet/withdraw/direct" method="post">
                        {{csrf_field()}}
                        <div class="card-body">
                            <div class="child-member">
                                <input type="number" min="0" name="wallet" max="{{$max_decrement}}">
                            </div>
                            <input type="submit" value="Withdraw">
                        </div>
                    </form>
                    @foreach($errors->all() as $e)
                    <div>$e</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
