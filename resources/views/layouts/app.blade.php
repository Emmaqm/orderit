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

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">

    <link href="{{ asset('css/algolia.css') }}" rel="stylesheet">

    @yield('extra-css')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-top sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'orderit') }}
                </a> 

                @include('partials.searchForm')

                <div class="d-flex d-md-none cart-menu">
                    <div class="cart-link">
                        <a href="{{ route('cart.index')}}">
                            <i class="mr-2 fas fa-boxes"></i>
                            @if (Cart::count() > 0)
                            <span class="cant-count">{{ Cart::count() }}</span>
                            @endif
                        
                        </a>
                    </div>


                        
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
                                            <button class="bt-secondary-white">Mi cuenta</button>
                                        </div>
        
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
        
                                        
                                    </div>
        
                                    
                                </li>
                            </ul>   
                    <!-- Left Side Of Navbar -->
                    <div class="navbar mr-auto">
                        <nav class="sidebar">
        
                            <ul class="list-unstyled components">
                                <li class="{{ active(['home', 'home/*', '/']) }}">
                                    <a href="{{ url('/home') }}">
                                        <i class="fas fa-home"></i>
                                        <p>Inicio</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#categories-modal">
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
                                        <li>
                                            <a  href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                          document.getElementById('logout-form').submit();">
                                             {{ __('Cerrar Sesión') }}
                                            </a>
                                        </li>
                                    </ul>
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
            <!-- Sidebar  -->
            <nav id="sidebar" class="sidebar position-fixed">
              
                
                <div class="cart-link text-center">
                    <a href="{{ route('cart.index')}}"><i class="fas fa-boxes"></i></a>
                    @if (Cart::count() > 0)

                    <div class="mt-2">
                        <span class="cant-count mini">{{ Cart::count() }}</span>
                    </div>
                    
                    @endif
                    <a class="mi-pedido" href="{{ route('cart.index')}}">
                        @if (Cart::count() > 0)
                        <span class="cant-count">{{ Cart::count() }}</span>
                        @endif
                        Mi pedido</a>
                </div>
                

                <ul class="list-unstyled components">
                    <li class="{{ active(['home', 'home/*', '/']) }}">
                        <a href="{{ url('/home') }}">
                            <i class="fas fa-home"></i>
                            <p>Inicio</p>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown show dropright">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-th-large"></i>
                                <p>Categorías</p>
                            </a>
                          
                            <div class="dropdown-menu p-0" id="categories-container" aria-labelledby="dropdownMenuLink">
                          
                                <div class="d-flex" id="categories-wrapper">
                                    <div class="categories --back-color-secondary">
                                      @foreach ($categories as $category)
                                        <a id="{{ $category->nom_low }}" class="category dropdown-item" href="#">{{ $category->nombre }}</a>
                                      @endforeach
                                    </div>
                                      
                                      @foreach ($categories as $category)
                                        <div id="{{ $category->nom_low }}-items" class="subcategories flex-column flex-wrap">
                                            @foreach ($subcategories as $subcategory)
                                              @if ($subcategory->category_id == $category->id)
                                                <a class="dropdown-item subcategory" href="{{ route('search', ['menu[subcategories]'=> $subcategory->nombre]) }}">{{ $subcategory->nombre }}</a>
                                              @endif
                                            @endforeach
                                  
                                        </div>
                                      @endforeach
                                        
                                </div>
                            </div>
                        </div>
                        
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
            
                <main class="p-0">
                    @yield('content')
                </main>

            </div>



            <div class="modal fade d-md-none" id="categories-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                    
                      <h5 id="categories-modal-title" class="modal-title modal-title-categorias ml-2">Categorías</h5>
                      <h5 id="back-subcategories" class="modal-title modal-title-subcategorias ml-2"><span class="btn-link"><i class="fas fa-arrow-left mr-3"></i></span><span id="subcategories-span"></span></h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                        
                        <div class="categories-responsive">
                            @foreach ($categories as $category)
                                <a id="{{ $category->nom_low }}R" class="category-responsive dropdown-item" href="#">{{ $category->nombre }} <i class="fas fa-chevron-right btn-link"></i></a>
                            @endforeach
                        </div>
                                    
                        @foreach ($categories as $category)
                            <div id="{{ $category->nom_low }}R-itemsR" class="subcategories-responsive">
                                @foreach ($subcategories as $subcategory)
                                    @if ($subcategory->category_id == $category->id)
                                        <a class="dropdown-item subcategory-responsive" href="{{ route('search', ['menu[subcategories]'=> $subcategory->nombre]) }}">{{ $subcategory->nombre }}</a>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                                      

                    </div>

                  </div>
                </div>
            </div>
        </div>


    </div>

    @yield('extra-js')

    <script>

        /*---- Alto dinámico del menu de categorías ------*/

        (function(){
          var categoria = document.getElementsByClassName('category');
          var catwrap = document.getElementById('categories-wrapper');
          var catcont = document.getElementById('categories-container');
          const catpadding = 24;
          const catheight = 40;
        
          var catxwidth = categoria.length * catheight;
        
          var catwidth = catpadding + catxwidth;
        
          catwrap.style.height =  catwidth + catheight + "px";
        
        }());
        
    </script>

    <!-- Include AlgoliaSearch JS Client and autocomplete.js library -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>
    <script src="https://cdn.jsdelivr.net/autocomplete.js/0/autocomplete.min.js"></script>
    <script src="{{ asset('js/algolia.js') }}"></script>

</body>
</html>
