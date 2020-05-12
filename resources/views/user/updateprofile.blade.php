@extends('layouts.app')

@section('content')
<div class="container col-10 container-decorate">

    <form action="/update" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-control">

            name
            <input type="text" name="name" value={{$user->name}}>
        </div>

        <div class="form-control">
            username
            <input type="text" name="username" value={{$user->username}}>
        </div>


        change password

        <div class="row">
            <div class="form-control col">
                old password
                <input type="text" name="old_password">
            </div>
            <div class="form-control col">
                password
                <input type="text" name="password">
            </div>
        </div>
        <div class="form-control">
            email
            <input type="text" name="email" value={{$user->email}}>
        </div>

        select packages
        <select name="package" id="">
            <option value="{{$user->package_id}}">
                Select
            </option>
            @foreach($packages as $p)
            <option value="{{$p->id}}">
                {{'Get Max Withdraw $'.($p->max_withdraw*(double)$p->max_balance).' for $'.$p->package_cost}}
            </option>
            @endforeach
        </select>

        Profile image

        @if($user->profile_image != 'none')
        <img src="{{asset("storage/images/$user->profile_image")}}" class="rounded-circle" style="width:75px " alt="">
        @else
        <img src="{{asset('images/user.jpg')}}" class="rounded-circle" style="width:75px " alt="">
        @endif

        <input type="file" name="profile_image">

        <input type="submit">
    </form>
</div>
@endsection