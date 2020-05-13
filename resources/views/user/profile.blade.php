@extends('layouts.app')

@section('content')

<div class="container pb-3 pt-5">
    <div class="row-centering">
            <div class="centering container-card-deck container-decorate">
            <h3 class="primary-color-text text-center">Hello {{Auth::user()->username}} Welcome to your profile page</h3>
                @if($user->profile_image != 'none')
                    <img src="{{asset('images/user.jpg')}}" class="rounded-circle" style="width:100px " alt="">
                @else
                    <img src="{{asset("storage/images/$c->profile_image")}}" class="rounded-circle"
                         style="width:100px " alt="">
                @endif
                <br>
                <h4>

                    <b>Username:</b> {{$user->username}}
                </h4>
                <h4>

                    <br>
                    <b>Email: </b>{{$user->email}}
                </h4>
                <h4>

                    <br>
                    <b>Generated referral code: </b>{{$user->referral_code}}
                </h4>
                <a type="submit" href="/update-profile" class="primary-color-btn">Update profile</a>
          
            </div>
</div>



@endsection