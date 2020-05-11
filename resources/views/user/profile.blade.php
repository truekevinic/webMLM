@extends('layouts.app')

@section('content')

<div class="container pb-3 pt-5">
    <div class="row  ">
        <h4 class="col my-auto text-center">Hello {{Auth::user()->username}} Welcome to your profile page</h4>

        <div class="form-group input-group ">

            @if($user->profile_image != 'none')
            <img src="{{asset("storage/images/$user->profile_image")}}" class="rounded-circle" style="width:75px "
                alt="">
            @else
            <img src="{{asset('images/user.jpg')}}" class="rounded-circle" style="width:75px " alt="">
            @endif

        </div>

    </div>
    <div class="row mx-auto col-8">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <p>Your Username</p>
                </div>
                <div class="card-body">
                    <p>{{Auth::user()->username}}</p>
                </div>
            </div>
        </div>
        <div class="col">

            <div class="card">
                <div class="card-header">
                    <p> Your Email</p>
                </div>
                <div class="card-body">
                    <p>{{Auth::user()->email}}</p>
                </div>
            </div>

        </div>
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <p> Your Refferal Code</p>
                </div>
                <div class="card-body">
                    <p>{{$user->referral_code}}</p>
                </div>
            </div>
        </div>

    </div>
    <div class="row mt-4"><a href="/update-profile" class=" btn-primary btn-lg mx-auto " role="button"
            aria-pressed="true">Update profile</a></div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 pb-5">
            <div class="card my-auto">
                <div class="card-header">
                    <h3>Members</h3>
                </div>
                <div class="card-body">

                    <table style="margin: 1.5em;">

                        @foreach($children as $c)
                        <tr>
                            <td>
                                @if($c->profile_image != 'none')
                                <img src="{{asset("storage/images/$c->profile_image")}}" class="rounded-circle"
                                    style="width:75px " alt="">
                                @else
                                <img src="{{asset('images/user.jpg')}}" class="rounded-circle" style="width:75px "
                                    alt="">
                                @endif
                            </td>
                            <td class="profile-member-list">
                                <li style="list-style: none;">{{$c->name }}</li>
                            </td>
                        </tr>

                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>



@endsection