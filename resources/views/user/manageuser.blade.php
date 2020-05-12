@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container-card-deck">
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
<<<<<<< HEAD
    <div class="container-card-deck">
        <h3 style="text-align:center;" class="primary-color-text">List of users</h3>
        <div class="row-centering">
            @foreach($users as $user)
            @if($user->name != 'admin' && $user->role_status == 'approved')
            <div class="centering container-card-deck-child">
=======
    <div class="my-5">
        <div class="card">
            <div class="card-header">
                <h3>List of pending suspend users</h3>
            </div>
            <div class="card-body">
                @foreach($users as $user)
                    @if($user->name != 'admin' && $user->suspend_status == 'pending')
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
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="my-5">
        <div class="card">
            <div class="card-header">
                <h3>List of users</h3>
            </div>
            <div class="card-body">
                @foreach($users as $user)
                @if($user->name != 'admin' && $user->role_status == 'approved')

>>>>>>> 7a47e409a8172284a8366e28cf883d1e4c644a2a
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
