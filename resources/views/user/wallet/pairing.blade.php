@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h3>Pairing Wallet<span class="badge badge-secondary">Balance: ${{$bonus->balance + $total_group_sale}}</span></h3>
            <br>
            <div class="container-card-deck container-decorate">
                <b>Personal Deposit: </b>${{$bonus->balance}}
                <br>
                <b>Group Deposit: </b>${{$total_group_sale}}
                <br><br>
                @foreach($group_sale_list as $g)
                <div>{{$g['user_id'].' '.$g['user_name'].' $'.$g['group_sale']}}</div>
                @endforeach
            </div>
            <br><br>
            <form action="add-deposit" method="post">
                {{csrf_field()}}
                <input type="number" min="0" name="deposit" class="decorative-input">
                <button class="primary-color-btn">Add Deposit</button>
            </form>
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
            <br>
            <form action="/wallet/withdraw/pairing" method="post">
                {{csrf_field()}}
                <div class="card-body">
                    <div class="child-member">
                        <input type="number" min="0" name="wallet2" class="decorative-input">
                        <input type="submit" value="Withdraw" class="primary-color-btn">
                    </div>

                    <form action="/wallet/withdraw/pairing" method="post">
                        {{csrf_field()}}
                        <div class="card-body">
                            <div class="child-member">
                                <input type="number" min="0" name="wallet" max="{{$bonus->balance}}">
                            </div>
                            <input type="submit" value="Withdraw">
                        </div>
                    </form>
                    @foreach($errors->all() as $e)
                    <div>$e</div>
                    @endforeach

                </div>
            </form>
            @foreach($errors->all() as $e)
            <div>{{$e}}</div>
            @endforeach
        </div>
    </div>
</div>
@endsection
