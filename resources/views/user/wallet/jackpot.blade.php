@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><p>Jackpot Wallet</p></div>
                    <div class="card-body">
                        <div class="child-member">
                            <div class="card-body">{{$bonus->balance}}</div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <p>Summaries</p>
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
                <div class="card">
                    <div class="card-header"><p>Withdraw</p></div>
                    <form action="/wallet/withdraw/jackpot" method="post">
                        {{csrf_field()}}
                        <div class="card-body">
                            <div class="child-member">
                                <input type="number" min="0" name="wallet3">
                            </div>
                        </div>
                    </form>
                    @foreach($errors->all() as $e)
                        <div>$e</div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
