@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><p>Pairing Wallet</p></div>
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
                <div class="card">
                    <div class="card-header"><p>Deposit</p></div>
                    <div class="card-body">
                        <form action="add-deposit" method="post">
                            {{csrf_field()}}
                            <input type="number" min="0" name="deposit">
                            <button>Add Deposit</button>
                        </form>
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
                    <form action="/wallet/withdraw/pairing" method="post">
                        {{csrf_field()}}
                        <div class="card-body">
                            <div class="child-member">
                                <input type="number" min="0" name="wallet2">
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
