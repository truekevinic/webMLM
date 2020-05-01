@extends('layouts.app')

@section('content')
{{--    summary data--}}

<div style="padding-top: 3em;">
    <div class="container">
        <div class="row">
            <div class="col-sm-5">
                <div class="container bg-light rounded sticky-positioning" style="padding: 3em;">
                    <h2>Your summary data</h2>
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
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{asset('images/black.jpg')}}" alt="Card image cap"
                        style="height: 13em;">
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{asset('images/black.jpg')}}" alt="Card image cap"
                        style="height: 13em;">
                    <div class="card-body">
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of
                            the card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm">
                <div class="card" style="width: 18rem;">
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
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">User</div>
                <a class="card-body" href="/summary/{{$user->id}}">
                    {{$user->name}}
                </a>
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    <p>Your Members</p>
                </div>
                <div class="card-body">
                    @foreach($children as $c)
                    <div class="child-member">
                        <a class="card-body" href="/summary/{{$c->id}}">
                            {{$c->name}}
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    <p>Unregistered Member</p>
                </div>
                <div class="card-body">
                    @foreach($unregisterUser as $c)
                    <div class="child-member">
                        <a class="card-body" href="/summary/{{$c->id}}">
                            {{$c->name}}
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">
                    <p>Hierarchy</p>
                </div>
                <div class="card-body">
                    @foreach($childList as $c)
                    <div class="child-member">
                        <a class="card-body" href="/summary/{{$c['user_id']}}">
                            {{'Parent '.$c['parent_id'].' Child '.$c['user_id'].' '.$c['user_name']}}
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <br>
            @component('layouts.tree')
            @endcomponent

            @if(count($unregisterUser) > 0)
            <form action='add-member' method="post">
                {{csrf_field()}}

                <div class="container-fluid">
                    Member
                    <select name="member_id" id="member-id" class="select-design rounded">
                        @foreach($unregisterUser as $u)
                        <option value="{{$u->id}}">{{$u->name}}</option>
                        @endforeach
                    </select>

                    with the Parent
                    <select name="parent_id" id="parent_id" class="select-design rounded">
                        @foreach($childList as $c)
                        <option value="{{$c['user_id']}}">{{$c['user_name']}}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-success">Submit</button>
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
</div>
@endsection