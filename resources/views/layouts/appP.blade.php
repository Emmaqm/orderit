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
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/addtohome.js') }}"></script>

    
    <!-- Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="mask-icon" href="/safari-pinned-tab.svg" color="#ef684a">
    <meta name="msapplication-TileColor" content="#fffbf9">
    <meta name="theme-color" content="#fffbf9">

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
{{-- 
    <link href="{{ asset('css/algolia.css') }}" rel="stylesheet"> --}}

    <script type="text/javascript" src="https://cdn.datatables.net/w/bs4/dt-1.10.18/datatables.min.js"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/w/bs4/dt-1.10.18/datatables.min.css"/>
 

    @yield('extra-css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-top sticky-top p-md-0">
            <div class="container-fluid">
                <div class="logo-wrapper mr-sm-4">
                    <a class="navbar-brand m-0" href="{{ url('/dashboard') }}">
                        <img src="{{ asset('img/logo-whitebg.svg') }}" alt="Logo orderit">
                    </a> 
                </div>

                <div class="d-flex d-md-none">                       
                    <button class="navbar-toggler p-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>


                <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">

                        <ul class="navbar-nav ml-auto">
                                <!-- Authentication Links -->
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle ml-sm-4" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                                            <a href="#">
                                                <span class="avatar-img" style="background-image: url('{{ asset('storage/'. Auth::user()->avatar) }}')"></span>

                                            </a>
                                            <p>{{ Auth::user()->nombre . " " . Auth::user()->apellido  }} <span class="caret"></span></p>
                                        </div>
        
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
        
                                        
                                    </div>
        
                                    
                                </li>
                            </ul>   
                    <!-- Mobile Navbar -->
                    <div class="navbar mr-auto">
                        <nav class="sidebar">
        
                            <ul class="list-unstyled components">
                                <li class="{{ active(['dashboard', 'dashboard/*']) }}">
                                    <a href="{{ url('/dashboard') }}">
                                        <i class="fas fa-tachometer-alt"></i>
                                        <p>Dashboard</p>
                                    </a>
                                </li>
                                <li class="{{ active(['gestionar-pedidos', 'gestionar-pedidos/*']) }}">
                                    <a href="{{ route('order.index') }}">
                                        <i class="fas fa-truck-loading"></i>
                                        <p>Gestionar Pedidos</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                                        <i class="fas fa-user"></i>
                                        <p>Mi cuenta</p>
                                    </a>
                                </li>
                                <li>
                                    <ul class="collapse list-unstyled" id="pageSubmenu">
                                        <li>
                                            <a href="#">Resumen</a>
                                        </li>
                                        <li>
                                            <a href="#">Preferencias</a>
                                        </li>
                                        <li>
                                            <a  href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                          document.getElementById('logout-form').submit();">
                                             {{ __('Cerrar Sesión') }}
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li>    
                                    <a href="#">
                                        <i class="fas fa-life-ring"></i>
                                        <p>Ayuda</p>
                                    </a>
                                </li>
                            </ul>
                    
                        </nav>  

                    </div>
                  
                </div>
            </div>
        </nav>

        <div class="wrapper">
            <!-- Sidebar desktop  -->
            <nav id="sidebar" class="sidebar position-fixed">

                <ul class="list-unstyled components mt-2">
                    <li class="{{ active(['dashboard', 'dashboard/*']) }}">
                        <a href="{{ url('/dashboard') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="{{ active(['gestionar-pedidos', 'gestionar-pedidos/*']) }}">
                        <a href="{{ route('order.index') }}">
                            <i class="fas fa-truck-loading"></i>
                            <p>Gestionar Pedidos</p>
                        </a>
                    </li>
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fas fa-user"></i>
                            <p>Mi cuenta</p>
                        </a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="#">Resumen</a>
                            </li>
                            <li>
                                <a href="#">Preferencias</a>
                            </li>
                        </ul>
                    </li>
                    <li>    
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
            
                <main class="p-0">
                    @yield('content')
                </main>

            </div>

        </div>


    </div>

    
    @yield('extra-js')

{{-- 
    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script> --}}

</body>
</html>
