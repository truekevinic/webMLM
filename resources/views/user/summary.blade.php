@extends('layouts.app')

@section('content')
{{--    summary data--}}
<div style="padding-top: 3em;">
    <div class="container">
        <div class="row">
            <div class="col-sm-5">
                <div class="container bg-light rounded sticky-positioning" style="padding: 3em;">
                    <h2 class="primary-color"><b>Your summary data</b></h2>
                    <br>
                    <div class="row">
                        <div class="col-sm">
                            <h4>Total: <span class="badge badge-secondary">{{$total}}</span></h4>
                        </div>
                    </div>
                    <br>
                    {{--progress bar here--}}
                    <div class="progress">
                        <div class="progress-bar w-75" role="progressbar" aria-valuenow="75" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <br>
                    <div class="progress">
                        <div class="progress-bar w-25" role="progressbar" aria-valuenow="25" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <br>
                    <div class="progress">
                        <div class="progress-bar w-50" role="progressbar" aria-valuenow="35" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <br>
                    <div class="progress">
                        <div class="progress-bar w-100" role="progressbar" aria-valuenow="55" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                    <br>
                    <div class="progress">
                        <div class="progress-bar w-25" role="progressbar" aria-valuenow="25" aria-valuemin="0"
                            aria-valuemax="100"></div>
                    </div>
                </div>
            </div>
            {{--                kasi paginate aja dah--}}
            <div class="col-sm-7" style="padding: 1em 3em 1em 3em;">
                @foreach($summaries as $s)
                <img src="{{asset('images/carousel/sushi.jpg')}}" alt=""
                    class="profile-picture-style border border-dark">
                @if($s->status == "increment")
                    <label style="color: #2a9055; font-weight: bold; font-size: 2em;">++</label>
                @else
                    <label style="color: red; font-weight: bold; font-size: 2em;">--</label>
                @endif
                {{$s->text}}
                <br><br>
                @endforeach
            </div>
        </div>
    </div>
    <br>
</div>

<div class="backGNoImage" style="padding: 3em; text-align: center;">
    <h1 style=" color: white;">About Us</h1>
    <p style=" color: white;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
        Culpa cupiditate deleniti dicta dignissimos earum id ipsum possimus?
        Consectetur deleniti dolorem, itaque iure laudantium magnam magni mollitia
        necessitatibus obcaecati odio voluptatibus.
    </p>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm">
                <div class="card" >
                    <img class="card-img-top" src="{{asset('images/black.jpg')}}" alt="Card image cap"
                         style="height: 13em;">
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card" >
                    <img class="card-img-top" src="{{asset('images/black.jpg')}}" alt="Card image cap"
                         style="height: 13em;">
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card">
                    <img class="card-img-top" src="{{asset('images/black.jpg')}}" alt="Card image cap"
                         style="height: 13em;">
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--    members data--}}

<div class="container py-5">
{{--    <div class="backGNoImage py-2 rounded">--}}
{{--        <h2 style="text-align: left; color: white;margin-left: 2em;">Hello, {{$user->name}}</h2>--}}
{{--    </div>--}}
    <br>
    <h4 style="text-align: center;" class="primary-color"><b>Your Members</b></h4>
    <br>
    <div class="row" style="display: flex;justify-content: center;align-items: center;">
        @foreach($children as $c)
            <div style="display: flex; padding: 0em 2em;">
                <div class="col" style="justify-content: center;">
                    <div class="row">
                        <img src="{{asset('images/carousel/sushi.jpg')}}" alt=""
                             class="bigger-profile-picture-style border border-dark">
                    </div>
                    <br>
                    <div class="row" style="justify-content: center;">
                        <p>Mr. {{$c->name}}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <br><br>
    <div class="row">
        @if(count($unregisterUser) > 0)
        <div class="col-sm-5">
            <div class="card">
                <div class="card-header">
                    <p class="primary-color"><b>Unregistered Member</b></p>
                </div>
                <div class="card-body">
                    @foreach($unregisterUser as $c)
                        <img src="{{asset('images/carousel/sushi.jpg')}}" alt=""
                             class="profile-picture-style border border-dark">
                        {{--                <a class="card-body" href="/summary/{{$c->id}}">--}}
                         &nbsp; {{$c->name}}
                        {{--                </a>--}}
                    @endforeach
                    <br><br>
                    <a href="#" class="btn btn-primary">View all</a>
                </div>
            </div>
        </div>
        <div class="col-sm-1"></div>
        @endif
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <p class="primary-color"><b>Hierarchy</b></p>
                </div>
                <div class="card-body">
                    @foreach($childList as $c)
                        <div class="child-member">
{{--                            @if($c['parent_id'] != $user->id)--}}
                                {{--                <a class="card-body" href="/summary/{{$c['user_id']}}">--}}
                                {{'Parent '.$c['parent_id'].' Child '.$c['user_id'].' '.$c['user_name']}}
                                {{--                </a>--}}
{{--                            @endif--}}
                        </div>
                    @endforeach
                        <br>
                    <a href="#" class="btn btn-primary">View tree</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @if(count($unregisterUser) > 0)
            <form action='add-member' method="post">
                {{csrf_field()}}

                <div class="container-fluid py-5">
                    <div class="row">
                        <p><b class="primary-color">Member</b></p> &nbsp;&nbsp;
                        <select name="member_id" id="member-id" class="select-design rounded">
                            @foreach($unregisterUser as $u)
                                <option value="{{$u->id}}">{{$u->name}}</option>
                            @endforeach
                        </select>

                        &nbsp;&nbsp;<p>with the <b class="primary-color">Parent</b></p> &nbsp;&nbsp;
                        <select name="parent_id" id="parent_id" class="select-design rounded">
                            @foreach($childList as $c)
                                <option value="{{$c['user_id']}}">{{$c['user_name']}}</option>
                            @endforeach
                        </select>
                        &nbsp;&nbsp;
                        <button class="btn btn-primary">Submit</button>
                    </div>

                </div>
            </form>
            <div>
                @foreach($errors->all() as $e)
                    <div>{{$e}}</div>
                @endforeach
            </div>
        @endif
    </div>
</div>


<div class="parallax"></div>
<br>
{{--    wallet data--}}
<br>
<div class="container" style="margin-bottom: 5em;">
    <div class="backGNoImage py-2 rounded">
        <h2 style="text-align: center; color: white;">
            Hello {{$user->name}}, this is your wallet data</h2>
    </div>
    <br><br><br>
    <div class="row">
        <div class="col">
            {{--                direct wallet--}}
            <div class="card">
                <div class="card-header">
                    <h2 style="text-align: center;" class="primary-color"><b>Direct Wallet,</b>
                        <span class="badge badge-secondary">{{$bonusDirect->balance}}</span></h2>
                </div>
                <div class="card-body">
                    <p><b class="primary-color">Summaries</b></p>
                    @foreach($summariesDirect as $s)
                        {{$s->text}}
                        @if($s->status == "increment")
                            <label style="color: #2a9055; font-weight: bold; font-size: 1.3em;">++</label>
                        @else
                            <label style="color: red; font-weight: bold; font-size: 1.3em;">--</label>
                        @endif
                        <br>
                    @endforeach

                    @if(Auth::user()->name != 'admin')
                        <div class="card">
                            <div class="card-header"><p>Upgrade Package</p></div>
                            <div class="card-body">
                                <form action="/wallet/upgrade-package" method="post">
                                    {{csrf_field()}}
                                    <select name="upgrade_package" id="upgrade_package">
                                        @foreach($packages as $p)
                                            @if($p->id > $user_package)
                                                <option value="{{$p->id}}">{{'Get Max Withdraw $'.($p->max_withdraw*(double)$p->max_balance).' for $'.$p->package_cost}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <button>Upgrade</button>
                                </form>
                            </div>
                        </div>
                    @endif
                    <br>
                    <p><b class="primary-color">Withdraw</b></p>
                    <form action="/wallet/withdraw/direct" method="post">
                        {{csrf_field()}}
                        <input type="number" min="0" name="wallet1">
                        <input type="submit" class="btn btn-primary" value="Withdraw" style="margin:0.5em;">
                    </form>
                    @foreach($errors->all() as $e)
                        <div>$e</div>
                    @endforeach
                </div>
            </div>
        </div>
        <br>
        <div class="col">
            {{--                pairing wallet--}}
            <div class="card">
                <div class="card-header">
                    <h2 style="text-align: center;"><b class="primary-color">Pairing Wallet,</b>
                        <span class="badge badge-secondary">
                            ${{$bonusPairing->balance+$total_group_sale}}
                        </span></h2>
                </div>
                <div class="card-body">
                    <b class="primary-color">Personal Deposit: </b><span class="badge badge-secondary">${{$bonusPairing->balance}}</span>
                    <br>
                    <b class="primary-color">Group Deposit </b><span class="badge badge-secondary">${{$total_group_sale}}</span>
                    <br><br>
                    @foreach($group_sale_list as $g)
                        <div>{{$g['user_id'].' '.$g['user_name']}} <span class="badge badge-secondary">${{$g['group_sale']}}</span></div>
                    @endforeach
                    <br>
                    <p><b class="primary-color">Deposit</b></p>
                    <form action="add-deposit" method="post">
                        {{csrf_field()}}
                        <input type="number" min="0" name="deposit">
                        <button class="btn btn-primary" style="margin: 0.5em;">Add Deposit</button>
                    </form>
                    @if(count($summariesPairing) > 0)
                        <p><b class="primary-color">Summaries</b></p>
                        @foreach($summariesPairing as $s)
                            <div class="card-body">
                                {{$s->text}}
                                @if($s->status == "increment")
                                    <label style="color: #2a9055; font-weight: bold; font-size: 1.3em;">++</label>
                                @else
                                    <label style="color: red; font-weight: bold; font-size: 1.3em;">--</label>
                                @endif
                            </div>
                        @endforeach
                    @endif
                    <br>
                    <p><b class="primary-color">Withdraw</b></p>
                    <form action="/wallet/withdraw/pairing" method="post">
                        {{csrf_field()}}
                        <input type="number" min="0" name="wallet2">
                        <input type="submit" class="btn btn-primary" value="Withdraw" style="margin:0.5em;">
                    </form>
                    @foreach($errors->all() as $e)
                        <div>$e</div>
                    @endforeach
                </div>
            </div>
        </div>
        <br>
    </div>
    <div class="row">
        {{--                jackpot wallet--}}
        <div class="card">
            <div class="card-header">
                <h2 style="text-align: center; "><b class="primary-color">Jackpot Wallet,</b>
                    <span class="badge badge-secondary">{{$bonusJackpot->balance}}</span></h2>
            </div>
            <div class="card-body">
                <p><b class="primary-color">Summaries</b></p>
                @foreach($summariesJackpot as $s)
                    {{$s->text}}
                    @if($s->status == "increment")
                        <label style="color: #2a9055; font-weight: bold; font-size: 1.3em;">++</label>
                    @else
                        <label style="color: red; font-weight: bold; font-size: 1.3em;">--</label>
                    @endif
                    <br>
                @endforeach
                <p><b class="primary-color">Withdraw</b></p>
                <form action="/wallet/withdraw/jackpot" method="post">
                    {{csrf_field()}}
                    <input type="number" min="0" name="wallet3">
                    <input type="submit" class="btn btn-primary" value="Withdraw" style="margin:0.5em;">
                </form>
                @foreach($errors->all() as $e)
                    <div>$e</div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection

