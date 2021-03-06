<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Yourtube') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://kit.fontawesome.com/8100dbee1b.js" crossorigin="anonymous"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Favicon -->
    <link rel="icon" href="{{ asset('storage/favicon.ico') }}"/>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('storage/logo_200x122.png') }}" style="width: 100px">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav" style="width: 100%;">
                    <div class="mx-auto search-dropdown">
                        <div class="input-group">
                            <input type="text" id="myInput" class="form-control" placeholder="Rechercher..."
                                   aria-label="rechercher" aria-describedby="rechercher"
                                   onfocus="myFunction()" onblur="myFunction()" oninput="getContent()"
                                   onkeyup="handle(event)">
                            <div class="input-group-append">
                                <a class="btn btn-outline-secondary" type="button" id="rechercher" onclick="route_results()"><i
                                        class="fas fa-search"></i></a>
                            </div>
                        </div>
                        <div id='myDropdown' class='dropdown-content'
                             onmouseover="document.getElementById('myInput').removeAttribute('onblur')"
                             onmouseleave="document.getElementById('myInput').setAttribute('onblur', 'myFunction()')">
                        </div>
                    </div>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Connexion') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Inscription') }}</a>
                            </li>
                        @endif
                    @else
                        <a href="{{route('profile_show', Auth::user()->name ?? '')}}">
                            @if(isset(Auth::user()->profile->avatar))
                                @if(strlen(Auth::user()->profile->avatar))
                                <img src="{{ asset('storage/' . Auth::user()->profile->avatar) }}" width="40"
                                     height="40" style="border-radius: 100%">
                                @else
                                    <img src="https://static.asianetnews.com/img/default-user-avatar.png" width="40"
                                         height="40" style="border-radius: 100%">
                                @endif
                            @else
                                <img src="https://static.asianetnews.com/img/default-user-avatar.png" width="40"
                                     height="40" style="border-radius: 100%">
                            @endif
                        </a>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ ucfirst(Auth::user()->name) }} <span class="caret"></span>
                            </a>


                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('home') }}">
                                    Dashboard
                                </a>
                                <a class="dropdown-item" href="{{ route('profile_show', Auth::user()->name ?? '') }}">
                                    Mon profil
                                </a>
                                @if(Auth::user()->hasAnyRole(['administrateur', 'moderateur']))
                                    <a class="dropdown-item" href="{{ route('reportings') }}">
                                        Administration
                                    </a>
                                @endif
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Se d??connecter') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @if(Auth::user()->hasAnyRole(['administrateur', 'moderateur']))
                            <div class="d-flex align-items-center">
                                <a href="{{route('reportings')}}"><span class="badge badge-danger"><i
                                            class="far fa-bell mr-1"></i>{{$notifications ?? '0'}}</span>
                                </a>
                            </div>
                        @endif

                        <a href="{{ route('video_form') }}">
                            <button type="submit" class="btn btn-light">
                                <i class="fas fa-upload"></i>
                            </button>
                        </a>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>
</div>

<script type="text/javascript">

    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    function getContent() {
        const search = document.getElementById('myInput');
        const myDropdown = document.getElementById('myDropdown');
        const searchValue = search.value;
        if (searchValue != "") {
            const xhr = new XMLHttpRequest();

            xhr.open('GET', '{{route("search")}}/?search=' + searchValue, true);
            xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
            xhr.onreadystatechange = function () {

                if (xhr.readyState == 4 && xhr.status == 200) {
                    myDropdown.innerHTML = xhr.responseText;
                }
            }
            xhr.send()
        } else {
            myDropdown.innerHTML = "";
        }
    }

    function handle(e) {
        const searchValue = document.getElementById("myInput").value;
        if(e.keyCode === 13){
            event.preventDefault();
            route_results();
        }
    }

    function route_results() {
        const searchValue = document.getElementById("myInput").value;
        const url = "{{route('results')}}/?search=" + searchValue;
        document.location.href = url;
    }
</script>
</body>
</html>
