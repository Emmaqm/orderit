<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <meta name="theme-color" content="#EF684A">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'orderIt') }} - @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#ef684a">
    <meta name="msapplication-TileColor" content="#fffbf9">
    <meta name="theme-color" content="#fffbf9">

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    @yield('extra-css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-top sticky-top">
            <div class="container-fluid">
                <div class="logo-wrapper mr-sm-4">
                    <a class="navbar-brand m-0" href="{{ url('/home') }}">
                        <img src="img/logo-whitebg.svg" alt="Logo orderit">
                    </a> 
                </div>

                <div class="d-flex d-md-none cart-menu">
                        
                    <button class="navbar-toggler p-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>


                <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">

                        <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->nombre . " " . Auth::user()->apellido  }} <span class="caret"></span>
                                    </a>
        
                                    <div class="dropdown-menu dropdown-menu-right --padding-zero align-items-center" aria-labelledby="navbarDropdown">
        
                                        <div class="dropdown-container-left">
            
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                {{ __('Cerrar Sesión') }}
                                            </a>
                                        </div>
                                        
                                        <div class="dropdown-container-right --back-color-secondary --text-white text-center --padding-20">
                                            <a href="#"><i class="fas fa-user-circle"></i></a>
                                            <p>{{ Auth::user()->nombre . " " . Auth::user()->apellido  }} <span class="caret"></span></p>
                                            {{-- <button class="bt-secondary-white">Mi cuenta</button> --}}
                                        </div>
        
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
        
                                        
                                    </div>
        
                                    
                                </li>
                            </ul>   
 
                </div>
            </div>
        </nav>

        <div class="wrapper">
          
            <div class="container mt-4 pt-4">
            
                <main class="p-0">
                   
                    @yield('content')

                </main>

            </div>

        </div>


    </div>

    @yield('extra-js')

</body>
</html>
