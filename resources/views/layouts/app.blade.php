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

    <script src="https://d3js.org/d3.v5.min.js"></script>
    <link href="{{ asset('css/cleanboot.css') }}" rel="stylesheet">
    <script>
        function openNav() {
          document.getElementById("mySidenav").style.width = "250px";
          document.getElementById("main").style.marginLeft = "250px";
        }
        
        function closeNav() {
          document.getElementById("mySidenav").style.width = "0";
          document.getElementById("main").style.marginLeft= "0";
        }
    </script>
    <style>
        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }

        #main {
            transition: margin-left .5s;
            padding: 16px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {
                padding-top: 15px;
            }

            .sidenav a {
                font-size: 18px;
            }
        }
    </style>
</head>

<body>

    <div id="mySidenav" class="sidenav text-light">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <ul class="navbar-nav active mr-auto mt-2 mt-lg-0 mx-5">
            <li class="nav-item active border-3">
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
            <li class="nav-item active">
                <a class="nav-link" href="{{url('package')}}">Package <span class="sr-only">(current)</span></a>
            </li>

            @endif

            <li class="nav-item active">
                <a class="nav-link" href="{{url('summary/'.Auth::user()->id)}}">Summary <span
                        class="sr-only">(current)</span></a>
            </li>


            <li class="nav-item active">
                <a class="nav-link" href="{{ route('profile') }}">Profile <span class="sr-only">(current)</span></a>
            </li>


            @endif
            <li class="nav-item">
                <div id="google_translate_element"></div>
            </li>
            <li class="nav-item">
                <div class=" nav-link white" href="#" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </div>
            </li>
    </div>
    <a class="nav-link border border-primary rounded" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
        {{ __('Logout') }}
    </a>
    </li>
    <li class="nav-item active">
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{csrf_field()}}
        </form>
        @endguest
    </li>
    </ul>
    </div>
    <div id="main">


        <div class="contain-all ">
            <div id="app">
                <main class="py-0 ">
                    <span style="font-size:30px;cursor:pointer; float: left;" onclick="openNav()">&#9776; LOGO</span>
                    @yield('content')
                </main>
            </div>
        </div>
        <br>
        <footer>
            <div class=" footer container-fluid backGNoImage py-2 text-center">
                <h6 class="text-light">&copy; SKY x Saya team</h6>
            </div>
        </footer>
    </div>
    <script src="{{ asset('js/translate.js') }}" defer></script>
</body>

</html>