@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center border-0">
        <div class="col-md-8 my-5">
            <div class="card ">
                <div class="card-header bg-primary text-light ">
                    <h2>Login</h2>
                </div>
                <br>
                <div class="card-body  ">
                    <form method="POST" action="{{ route('login') }}">
                        {{csrf_field()}}
                        <div class="form-group row input-group mx-auto  ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary text-light"><i class="fas fa-user"></i></span>
                                </div>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                                <br>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>


                        <div class="form-group row input-group mx-auto " >
                            <div class="input-group-prepend ">
                            <span class="input-group-text bg-primary text-light"><i class="fas fa-key"></i></span>
                            </div>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                <br>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        </div>

                        <div class="form-group row ">
                            <div class="mx-auto">
                                <div class="form-check">
                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="align-middle mx-auto">
                                <button type="submit" class="primary-color-btn">
                                    {{ __('Login') }}
                                </button>


                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-footer bg-primary text-light">
                    <div class="d-flex justify-content-center links">
                        Don't have an account?&nbsp;<a style=" color: rgb(0, 0, 0);" href="{{ route('register') }}">Sign Up</a>
                    </div>
                    <div class="d-flex justify-content-center">
                        @if (Route::has('password.request'))
                                    <a class="" style="color: rgb(0, 0, 0);"  href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
