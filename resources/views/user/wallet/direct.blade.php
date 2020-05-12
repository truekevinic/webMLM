@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3 class="">Direct Wallet<span class="badge badge-secondary">Balance: ${{$bonus->balance}}</span></h3>
            <br>
            <div class="container-card-deck container-decorate">
                <h3 class="primary-color-text text-center">Summaries</h3>
                <br>
                @foreach($summaries as $s)
                <div class="container-card-deck-child">
                    {{$s->text}}
                    @if($s->status == "increment")
                    <label style="color: #2a9055; font-weight: bold; font-size: 1.3em;">++</label>
                    @else
                    <label style="color: red; font-weight: bold; font-size: 1.3em;">--</label>
                    @endif
                </div>
                @endforeach
            </div>
            @if(Auth::user()->name != 'admin')
                <h3>Upgrade Package</h3>
                <div class="card-body">
                    <form action="/wallet/upgrade-package" method="post">
                        {{csrf_field()}}
<<<<<<< HEAD
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
=======
                        <div class="card-body">
                            <div class="child-member">
                                <input type="number" min="0" name="wallet" max="{{$max_decrement}}">
                            </div>
                            <input type="submit" value="Withdraw">
                        </div>
>>>>>>> 7a47e409a8172284a8366e28cf883d1e4c644a2a
                    </form>
                </div>
            @endif
            <br>
            <form action="/wallet/withdraw/direct" method="post">
                {{csrf_field()}}
                <div class="child-member">
                    <input type="number" min="0" name="wallet1" class="decorative-input">
                    <input type="submit" value="Withdraw" class="primary-color-btn">
                </div>
            </form>
            @foreach($errors->all() as $e)
            <div>{{$e}}</div>
            @endforeach
        </div>
    </div>
</div>
@endsection
