@extends('layouts.app')

@section('content')
<div class="container">
    <div class="my-5">
        <div class="card">
            <div class="card-header">
                <h3>List of registered users</h3>
            </div>
            <div class="card-body">
                @foreach($users as $user)
                @if($user->name != 'admin' && $user->role_status == 'unapproved')
                <form action="/approve-user/{{$user->id}}" method="post">
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
                    <br>
                    <input type="submit" value="Approve" />
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

                <form action="/suspend-control/{{$user->id}}" method="post">
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
                    <br>
                    @if($user->suspend_status == 'suspend')
                    <input type="submit" value="unsuspend" />
                    @else
                    <input type="submit" value="suspend" />
                    @endif
                    <br>
                </form>
                @endif
                @endforeach
            </div>
        </div>
    </div>




</div>
@endsection