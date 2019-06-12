<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'orderIt') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-top sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'orderIt') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->nombre . " " . Auth::user()->apellido  }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right --padding-zero align-items-center" aria-labelledby="navbarDropdown">

                                <div class="dropdown-container-left">
                                    <a class="dropdown-item" href="#">Pedidos</a>
                                    <a class="dropdown-item" href="#">Seguimiento</a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesión') }}
                                    </a>
                                </div>
                                
                                <div class="dropdown-container-right --back-color-secondary --text-white text-center --padding-20">
                                    <a href="#"><i class="fas fa-user-circle"></i></a>
                                    <p>{{ Auth::user()->nombre . " " . Auth::user()->apellido  }} <span class="caret"></span></p>
                                    <button class="bt-secondary">Mi cuenta</button>
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
            <!-- Sidebar  -->
            <nav id="sidebar" class="sidebar position-fixed">
        
                <ul class="list-unstyled components">
                    <li class="active">
                        <a href="#">
                            <i class="fas fa-home"></i>
                            <p>Inicio</p>
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-th-large"></i>
                            <p>Categorías</p>
                        </a>
                        <a href="#">
                            <i class="fas fa-warehouse"></i>
                            <p>Proveedores</p>
                        </a>
                        <a href="#">
                            <i class="fas fa-clock"></i>
                            <p>Reciente</p>
                        </a>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fas fa-user"></i>
                            <p>Mi cuenta</p>
                        </a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="#">Resumen</a>
                            </li>
                            <li>
                                <a href="#">Mis Pedidos</a>
                            </li>
                            <li>
                                <a href="#">Preferencias</a>
                            </li>
                        </ul>
                        <a href="#">
                            <i class="fas fa-life-ring"></i>
                            <p>Ayuda</p>
                        </a>
                    </li>
                </ul>

                <button type="button" id="sidebarCollapse" class="btn-dock">
                    <img src="{{ asset('img/dock-icon.svg') }}" alt="Dock sidebar button">
                </button>
        
            </nav>
        
            <!-- Page Content  -->
            <div id="content">
            
                <main class="py-4">
                    @yield('content')
                </main>

            </div>
        </div>


    </div>
</body>
</html>
