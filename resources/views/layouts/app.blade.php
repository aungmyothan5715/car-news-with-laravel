<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CarNews') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
       <!-- For Fontawesome -->
    <link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    


    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="my-style.css">
    <style>
        
        .navbar-brand{
            padding: 2px;
            cursor: pointer;
            font-size: 19px;
            color: rgba(57, 57, 248, 0.675);
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-weight: bold;
            font-style: italic;
        }
        .navbar-brand:hover{
            color:rgb(41, 41, 235);
        }
        .nav-item{
            margin-left: 14px;
            padding: 2px;
            cursor: pointer;
            font-size: 16px;
            color: rgba(57, 57, 248, 0.675);
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            font-weight: bold;
            font-style: italic;
        }
        .nav-item:hover{
            
            color:rgb(41, 41, 235);
        }
        .nav-item a{
            list-style-type: none;
            text-decoration: none;
        }
        #create-link{
        
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md bg-light shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/posts') }}">
                    {{ config('app.name', 'CarNews') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item" id="nav-item"><a href="#" class="">Home</a></li>
                        <li class="nav-item" id="nav-item"><a href="#" class="">Services</a></li>
                        <li class="nav-item" id="nav-item"><a href="#" class="">About</a></li>
                        <li class="nav-item" id="nav-item"><a href="#" class="">Contact</a></li>
                        <li class="nav-item" id="nav-item">
                            
                        @if( auth()->user() )
                            @if(auth()->user()->id === 5)
                            <a href="{{ route('post.create') }}" id="create-link">Add New Post</a>
                            @endif
                        @endif
                        </li>

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>



                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <a class="dropdown-item">
                                        BG
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @extends('layouts.footer');
</body>
</html>
