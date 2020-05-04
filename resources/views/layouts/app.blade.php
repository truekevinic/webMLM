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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <script src="https://d3js.org/d3.v5.min.js"></script>

</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark backGNoImage" >
    <a class="navbar-brand" href="#">LOGO</a>
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
                    <li class="nav-item active">
                        <a class="nav-link" href="{{url('package')}}">Package <span class="sr-only">(current)</span></a>
                    </li>
                @endif

                <li class="nav-item active">
                    <a class="nav-link" href="{{url('summary/'.Auth::user()->id)}}">Summary <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('profile') }}">Profile <span class="sr-only">(current)</span></a>
                </li>

            @endif
        </ul>
        <div class="logout-btn nav-item float-right inline-box">
            <div class="user-logged inline-box">
                <li class="nav-item">
                    <div id="google_translate_element"></div>
                </li>
                <li class="nav-item">
                    <div class=" nav-link white" href="#" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </div>
                </li>
            </div>
            <a class="nav-link border border-primary rounded" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
        </div>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{csrf_field()}}
        </form>
        @endguest
    </div>
</nav>

<div class="contain-all">
    <div id="app">
        <main class="py-0">
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

<script src="{{ asset('js/translate.js') }}" defer></script>
</body>
</html>
