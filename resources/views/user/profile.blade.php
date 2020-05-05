@extends('layouts.app')

@section('content')

<div class="container pb-3 pt-5 col-md-8 ">
    <div class="row  ">
        <h4 class="col my-auto text-center">Hello {{Auth::user()->username}} Welcome to your profile page</h4>
            <div class="form-group input-group col-12">
                <img src="{{asset('images/user.jpg')}}" class="rounded-circle  mx-auto" style="width:100px " alt="">

            </div>

    </div>
    <div class="row mx-auto">
        <div class="col"></div>
        <div class="col">
            <p>your username/referral :</p>
            <div class="form-group input-group">
                
                <div class="input-group-prepend">
                    <span class="input-group-text bg-dark text-light"><i class="fas fa-user"></i></span>
                </div>
                <div class="col-1">{{Auth::user()->username}}</div>
            </div>
            
            
        </div>
        <div class="col">
            <p> Your Email</p>
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-dark text-light"><i class="fas fa-envelope"></i></span>
                </div>
                <div class="col-1">{{Auth::user()->email}}</div>
                
            </div>
            
        </div>
        <div class="col"></div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8 pb-5">
        <div class="card my-auto">
            <div class="card-header">
                <h3>Members</h3>
            </div>
            <div class="card-body">

                <table style="margin: 1.5em;">

                    @foreach($children as $c)
                    <tr>
                        <td>
                            <img src="{{asset('images/user.jpg')}}" class="rounded-circle" style="width:75px " alt="">
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
</div>

@endsection