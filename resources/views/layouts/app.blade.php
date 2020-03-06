<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
<div class="contain-all">
    <div id="app">
        <div class="header">
            <div class="first-header">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Home
                </a>
                @guest
                    <div class="login-register-option">
                        <li class="nav-item">
                            <div id="google_translate_element"></div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    </div>
                @else
                    <div class="user-logged">
                        <li class="nav-item">
                            <div id="google_translate_element"></div>
                        </li>
                        <li class="nav-item dropdown ">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                        </li>
                    </div>
            </div>
            <div class="second-header">
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{route('profile')}}">
                        {{ __('Profile') }}
                    </a>

                    <a class="dropdown-item" href="{{url('wallet/jackpot/'.Auth::user()->id)}}">
                        {{ __('Jackpot Wallet') }}
                    </a>

                    <a class="dropdown-item" href="{{url('wallet/pairing/'.Auth::user()->id)}}">
                        {{ __('Pairing Wallet') }}
                    </a>

                    <a class="dropdown-item" href="{{url('wallet/direct/'.Auth::user()->id)}}">
                        {{ __('Direct Wallet') }}
                    </a>

                    <a class="dropdown-item" href="{{url('wallet/withdraw/'.Auth::user()->id)}}">
                        {{ __('Withdraw') }}
                    </a>

                    <a class="dropdown-item" href="{{url('child/'.Auth::user()->id)}}">
                        {{ __('Members') }}
                    </a>


                    <a class="dropdown-item" href="{{url('summary/'.Auth::user()->id)}}">
                        {{ __('Summary') }}
                    </a>

                    <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            @endguest
        </div>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</div>
<script src="{{ asset('js/translate.js') }}" defer></script>
</body>
</html>
