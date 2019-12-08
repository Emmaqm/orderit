@extends('layouts.app')

@section('title', 'Resultados de la búsqueda')

@section('extra-css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/instantsearch.js@2.10.4/dist/instantsearch.min.css">   
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/instantsearch.js@2.10.4/dist/instantsearch-theme-algolia.min.css">
@endsection

@section('content')




<div class="d-flex mt-0 mt-sm-2">


    <div class="col-lg-9 col-md-8 p-0 hits-container">
        <div class="text-center text-sm-left d-sm-flex justify-content-between pl-4 pr-4 mb-2">
            @if (app('request')->input('query'))
                <div class="mb-4">
                    <h2 class="text-center text-md-left ml-lg-5 ml-0 mt-2 mb-2">Resultados para: <span class="text-capitalize font-weight-light">{{ app('request')->input('query') }}</span> </h2>
                    <div class="underline d-none d-lg-block"></div>
                    <div class="d-none" id="breadcrumb">        
                        <!-- RefinementList widget will appear here -->
                    </div> 
                </div>
            
            @else
                <div id="breadcrumb" class="ml-sm-4 pl-sm-4 mt-2 mr-2">        
                    <!-- RefinementList widget will appear here -->
                </div>    
            @endif
        
            <div class="d-flex justify-content-around mt-4 mt-sm-0 mb-2 mb-sm-0">
                <button class="btn bt-primary" id="filtros-open"><span class="fas fa-filter mr-2"></span>Filtrar</button>
        
                <div class="mr-lg-4 pr-lg-4 ml-2">
                    <div id="ordenar">
                        <!-- SortBy widget will appear here -->
                    </div>
                </div>
            </div>                                                                
        </div>
        <div class="products" id="hits">
            <!-- Hits widget will appear here -->
        </div>
            
        <div id="pagination">
            <!-- Pagination widget will appear here -->
        </div>
    </div>

    <div class="bg-filtros" id="bg-filtros"></div>

    <div id="filtros" class="col-lg-3 col-md-4 filtros p-4 p-sm-3">

        <div class="d-none">
            <div class="d-none" id="search-box">
                <!-- SearchBox widget will appear here -->
            </div>
        </div>
        
        <div class="ml-3 ml-sm-0">
            <div>
                <div class="d-flex justify-content-between">
                    <h4 class="mt-4 pt-sm-4 font-weight-bold">Filtros:</h4>
                    <div class="mt-4 pt-sm-4">
                        <button id="filtros-close" class="fas fa-times text--darkest-grey"></button>
                    </div>
                </div>

                <h5 class="text--darkest-grey mt-4 mb-3">Categorías</h5>
                <div id="refinement-list-subcategory">        
                        <h5 class="text--darkest-grey mt-4 mb-3">Categorías</h5>
                        <!-- RefinementList widget will appear here -->
                </div>
            </div>
                
            <div>
                <h5 class="text--darkest-grey mt-4 mb-3">Marca</h5>
                <div id="refinement-list-brand">        
                        <!-- RefinementList widget will appear here -->
                </div>
            </div>
                
            <div>
                <h5 class="text--darkest-grey mt-4 mb-3">Capacidad</h5>
                <div id="refinement-list-capacity">        
                        <!-- RefinementList widget will appear here -->
                </div>
            </div>
        </div>

        <button id="apply-filters" class="apply-filters">
            Ver Productos
        </button>
    </div>
    
</div>




@endsection

@section('extra-js')
    <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@2.10.4"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script> --}}
    <script src="{{ asset('js/algolia-instant.js') }}"></script>
@endsection