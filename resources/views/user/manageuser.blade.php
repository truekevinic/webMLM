@extends('layouts.app')

@section('content')
<div class="container">
    <br><br>
    <div class="container-card-deck container-decorate">
        <h3 style="text-align:center;" class="primary-color-text">List of registered users</h3>
        <div class="row-centering">
            @foreach($users as $user)
            @if($user->name != 'admin' && $user->role_status == 'unapproved')
            <div class="centering container-card-deck-child">
                <form action="/approve-user/{{$user->id}}" method="post">
                    {{csrf_field()}}
                    @if($user->profile_image != 'none')
                        <img src="{{asset('images/user.jpg')}}" class="rounded-circle" style="width:75px " alt="">
                    @else
                        <img src="{{asset("storage/images/$user->profile_image")}}" class="rounded-circle"
                             style="width:75px " alt="">
                    @endif
                    <br>
                    <b>Username:</b> {{$user->username}}
                    <br>
                    <b>Email: </b>{{$user->email}}
                    <br>
                    <b>Package: </b>{{$user->package_id}}
                    <br>
                    <b>Generated referral code: </b>{{$user->referral_code}}
                    <br><br>
                    <input type="submit" value="Approve" class="primary-color-btn"/>
                    <br>
                </form>
            </div>
            @endif
            @endforeach
        </div>
    </div>
    <br><br>
    <div class="container-card-deck container-decorate">
        <h3 style="text-align:center;" class="primary-color-text">List of pending suspends users</h3>
        <div class="row-centering">
            @foreach($users as $user)
                @if($user->name != 'admin' && $user->suspend_status != 'unsuspend')
                    <div class="centering container-card-deck-child">
                        <form action="/unsuspend-user/{{$user->id}}" method="post">
                            {{csrf_field()}}
                            @if($user->profile_image != 'none')
                                <img src="{{asset("storage/images/$user->profile_image")}}" class="rounded-circle"
                                     style="width:75px " alt="">
                            @else
                                <img src="{{asset('images/user.jpg')}}" class="rounded-circle" style="width:75px " alt="">
                            @endif
                            <br>
                            {{$user->name}}
                            {{$user->email}}
                            {{$user->package_id}}
                            {{$user->referral_code}}
                            <br>
                            <input type="submit" value="Unsuspend" />
                            <br>
                        </form>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    <br><br>
    <div class="container-card-deck container-decorate">
        <h3 style="text-align:center;" class="primary-color-text">List of users</h3>
        <div class="row-centering">
            @foreach($users as $user)
            @if($user->name != 'admin' && $user->suspend_status == 'unsuspend' && $user->role_status = 'active')
            <div class="centering container-card-deck-child">
                <form action="/suspend-control/{{$user->id}}" method="post">
                    {{csrf_field()}}
                    @if($user->profile_image != 'none')
                        <img src="{{asset('images/user.jpg')}}" class="rounded-circle" style="width:75px " alt="">
                    @else
                        <img src="{{asset("storage/images/$user->profile_image")}}" class="rounded-circle"
                             style="width:75px " alt="">
                    @endif
                    <br>
                    <b>Username:</b> {{$user->username}}
                    <br>
                    <b>Email: </b>{{$user->email}}
                    <br>
                    <b>Package: </b>{{$user->package_id}}
                    <br>
                    <b>Generated referral code: </b>{{$user->referral_code}}
                    <br><br>
                    @if($user->suspend_status == 'suspend')
                    <input type="submit" class="primary-color-btn" value="unsuspend" />
                    @else
                    <input type="submit" class="primary-color-btn" value="suspend" />
                    @endif
                    <br>
                </form>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
