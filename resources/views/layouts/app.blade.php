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
    <script src="{{ asset('js/d3.min.js') }}" defer></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('navbar/css/style.css') }}">
    <script src="https://d3js.org/d3.v5.min.js"></script>
    <link href="{{ asset('css/cleanboot.css')}}" rel="stylesheet">
</head>

<body>
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <div class="p-4 pt-5">
                <h1><a href="index.html" class="logo">LOGO</a></h1>
                <ul class="list-unstyled components mb-5">

                    @guest
                    <li>
                        <a href="{{ route('login') }}">Login</a>
                    </li>
                    @if (Route::has('register'))
                    <li>
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                    @endif
                    @else
                    <li>
                        <div href="#" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </div>
                        <a></a>
                    </li>
                    @if(Auth::user()->active_status == 'active')

                    <li>
                        <a href="{{ route ('home')}}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    @if(Auth::user()->name == 'admin')
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">Manage</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="{{url('package')}}">Package</a>
                            </li>
                            <li>
                                <a href="{{url('manage-user')}}">User</a>
                            </li>
                            <li>
                                <a href="{{url('manage-pin')}}">Pin</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">Menu</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="{{ route('profile') }}">Profile</a>
                            </li>
                            <li>
                                <a href="{{url('summary/'.Auth::user()->id)}}">Summary</a>
                            </li>
                            <li>
                                <a href="{{url('child/'.Auth::user()->id)}}">Members</a>
                            </li>

                        </ul>
                    </li>
                    <li>
                        <a href="#pageSubmenu1" data-toggle="collapse" aria-expanded="false"
                            class="dropdown-toggle">Wallet</a>
                        <ul class="collapse list-unstyled" id="pageSubmenu1">
                            <li>
                                <a href="{{url('wallet/direct/'.Auth::user()->id)}}">Direct</a>
                            </li>
                            <li>
                                <a href="{{url('wallet/pairing/'.Auth::user()->id)}}">Pairing</a>
                            </li>
                            <li>
                                <a href="{{url('wallet/jackpot/'.Auth::user()->id)}}">Jackpot</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{url('advertisement/'.Auth::user()->id)}}">Advertisement</a>
                    </li>
                    @endif
                    <li class="py-3">
                        <div id="google_translate_element"></div>
                    </li>

                    <li>
                        <a class="" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                    </li>
                </ul>

                <div class="mb-5">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{csrf_field()}}
                    </form>
                </div>
                @endguest
                <div class="footer">
                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | This template
                        is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="https://colorlib.com"
                            target="_blank">Colorlib.com</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>

            </div>
        </nav>
        {{-- <nav class="navbar navbar-expand-lg navbar-dark bg-dark" >
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav active">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route ('home')}}">Home <span class="sr-only">(current)</span></a>
        </li>
        @guest
        <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
        @if (Route::has('register'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Register</a>
        </li>
        @endif
        @else
        @if(Auth::user()->active_status == 'active')
        @if(Auth::user()->name == 'admin')
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">Manage</a>
            <div class="dropdown-menu" aria-labelledby="dropdownId">
                <a class="dropdown-item" href="{{url('package')}}">Package</a>
            </div>
        </li>
        @endif
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">Menu</a>
            <div class="dropdown-menu" aria-labelledby="dropdownId">
                <a class="dropdown-item" href="{{ route('profile') }}">Profile</a>
                <a class="dropdown-item" href="{{url('summary/'.Auth::user()->id)}}">Summary</a>
                <a class="dropdown-item" href="{{url('child/'.Auth::user()->id)}}">Members</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">Wallet</a>
            <div class="dropdown-menu" aria-labelledby="dropdownId">
                <a class="dropdown-item" href="{{url('wallet/direct/'.Auth::user()->id)}}">Direct</a>
                <a class="dropdown-item" href="{{url('wallet/pairing/'.Auth::user()->id)}}">Pairing</a>
                <a class="dropdown-item" href="{{url('wallet/jackpot/'.Auth::user()->id)}}">Jackpot</a>
            </div>
        </li>
        @endif
        </ul>
        <div class="logout-btn nav-item float-right inline-box">
            <div class="user-logged inline-box">
                <li class="nav-item">
                    <div id="google_translate_element"></div>
                </li>
                <li class="nav-item">
                    <div class=" nav-link white" href="#" role="button" aria-haspopup="true" aria-expanded="false"
                        v-pre>
                        {{ Auth::user()->name }}
                    </div>
                </li>
            </div>
            <a class="nav-link border border-primary rounded" href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{csrf_field()}}
        </form>
        @endguest
    </div>
    </nav> --}}

    <div id="content">
        <div id="app">
            <main class="py-0">
                @yield('content')
            </main>
        </div>
    </div>
    </div>
    <script src={{ asset('navbar/js/jquery.min.js') }}></script>
    <script src={{ asset('navbar/js/popper.js') }}></script>
    <script src={{ asset('navbar/js/bootstrap.min.js') }}></script>
    <script src={{ asset('navbar/js/main.js') }}></script>
    <script src="{{ asset('js/translate.js') }}" defer></script>
</body>

</html>
