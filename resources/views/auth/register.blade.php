@extends('layouts.app')

@section('content')
<div class="row my-5">
    <div class="col-md-3 register-left my-auto">

        <h3>Welcome</h3>
        <p>You are 5 minutes away from earning your own money!</p>

        <a href="{{ route('login') }}">Login</a>
        <br />
    </div>
    <div class="col-md-9 register-right backGNoImage">
        <h3 class="register-heading">Register as our partner</h3>
        <form method="POST" action="{{ route('register') }}">@csrf
            <div class="row register-form">
                <div class="col-md-6">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-dark text-light"><i class="fas fa-user"></i></span>
                        </div>
                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror"
                            name="username" value="{{ old('username') }}" required autocomplete="username" autofocus
                            placeholder="Username">
                        @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-dark text-light"><i class="fas fa-font"></i></span>
                        </div>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                            placeholder="Your Name">

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-dark text-light"><i class="fas fa-lock"></i></span>
                        </div>
                        <input id="password" type="password"
                            class="form-control @error('password') is-invalid @enderror" name="password" required
                            autocomplete="new-password" value="{{ old('password')}}" placeholder="Password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-dark text-light"><i class="fas fa-lock"></i></span>
                        </div>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required autocomplete="new-password" value="{{ old('password_confirmation')}}"
                            placeholder="Confirm Password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-dark text-light"><i class="fas fa-envelope"></i></span>
                        </div>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email"
                            placeholder="Your Email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-dark text-light"><i class="fas fa-archive"></i></span>
                        </div>
                        <select name="package" id="package" class="form-control @error('password') is-invalid @enderror"
                            required>
                            <option value="">Select Package</option>
                            @foreach($packages as $p)
                            <option value="{{$p->id}}" {{old('package') == $p->id ? 'selected' : ''}}>
                                {{'Get Max Withdraw $'.($p->max_withdraw*(double)$p->max_balance).' for $'.$p->package_cost}}
                            </option>
                            @endforeach
                        </select>

                        @error('package')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-dark text-light"><i class="fas fa-users"></i></span>
                        </div>
                        <input id="referral_code" type="text" class="form-control @error('referral_code') is-invalid @enderror"
                            name="referral_code" required placeholder="Referral User" value="{{$referral_code}}">

                        @error('referral_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-dark text-light"><i class="fas fa-users"></i></span>
                        </div>
                        <input id="pin" type="text" class="form-control @error('pin') is-invalid @enderror"
                               name="pin" required placeholder="Pin" value="{{old('pin')}}">

                        @error('pin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-dark">
                        {{ __('Register') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
