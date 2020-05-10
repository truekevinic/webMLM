@extends('layouts.app')

@section('content')
    <form action="/update" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        name
        <input type="text" name="name" value={{$user->name}}>
        <br>
        username
        <input type="text" name="username" value={{$user->username}}>
        <br>

        change password
        <br>
        old password
        <input type="text" name="old_password">
        password
        <input type="text" name="password">
        <br>
        email
        <input type="text" name="email" value={{$user->email}}>

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
        <br>
        Profile image

        @if($user->profile_image != 'none')
            <img src="{{asset("storage/images/$user->profile_image")}}" class="rounded-circle" style="width:75px " alt="">
        @else
            <img src="{{asset('images/user.jpg')}}" class="rounded-circle" style="width:75px " alt="">
        @endif

        <input type="file" name="profile_image">

        <input type="submit">
    </form>
@endsection
