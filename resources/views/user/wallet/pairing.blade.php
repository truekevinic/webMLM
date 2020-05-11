@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="my-5">
                <div class="card">
                    <div class="card-header">
                        <h3>Pairing Wallet</h3>
                    </div>
                    <div class="card-body">
                        <div class="child-member">
                            <div class="card-body">Personal Deposit: {{$bonus->balance}}</div>
                            <div class="card-body">
                                Group Deposit ${{$total_group_sale}}
                                @foreach($group_sale_list as $g)
                                <div>{{$g['user_id'].' '.$g['user_name'].' $'.$g['group_sale']}}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-5">
                <div class="card">
                    <div class="card-header">
                        <h3>Deposit</h3>
                    </div>
                    <div class="card-body">
                        <form action="add-deposit" method="post">
                            {{csrf_field()}}
                            <input type="number" min="0" name="deposit">
                            <button>Add Deposit</button>
                        </form>
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
                <div class="card">
                    <div class="card-header">
                        <h3>Withdraw</h3>
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
            </div>
        </div>
    </div>
</div>
@endsection
