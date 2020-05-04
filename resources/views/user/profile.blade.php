@extends('layouts.app')

@section('content')

<div class="container py-5 col-10">
    <div class="row ">
        <div class="col-2 mx-auto text-center">
            <div class="form-group input-group">
                <img src="{{asset('images/carousel/sushi.jpg')}}" class="rounded-circle mx-auto" style="width:100px " alt="">

            </div>
            <h4>Hello {{Auth::user()->username}} Welcome to your profile page</h4>
        </div>
        <div class="col-md-4">
            <p>your username/referral :</p>
            <div class="form-group input-group">
                
                <div class="input-group-prepend">
                    <span class="input-group-text bg-dark text-light"><i class="fas fa-user"></i></span>
                </div>
                <div class="col-1">{{Auth::user()->username}}</div>
            </div>
            

        </div>
        <div class="col-md-4">
            <p> Your Email</p>
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-dark text-light"><i class="fas fa-envelope"></i></span>
                </div>
                <div class="col-1">{{Auth::user()->email}}</div>

            </div>
 
        </div>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card my-auto">
            <div class="card-header">
                <h3>Members</h3>
            </div>
            <div class="card-body">

                <table style="margin: 1.5em;">

                    @foreach($children as $c)
                    <tr>
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