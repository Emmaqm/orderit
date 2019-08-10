@extends('layouts.app')

@section('title', 'Resultados de la búsqueda')

@section('extra-css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/instantsearch.js@2.10.4/dist/instantsearch.min.css">   
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/instantsearch.js@2.10.4/dist/instantsearch-theme-algolia.min.css">
@endsection

@section('content')

<div class="text-center text-sm-left">
    <h4 class="text-center text-md-left ml-lg-5 ml-0 mt-2 mb-2 text--dark-grey"><strong class="text--darkest-grey mr-1"><span class="text-capitalize">Resultados</span> para: </strong> {{ app('request')->input('query') }}</h4>
                                                                                             
    <div class="underline d-none d-lg-block"></div>

    <button class="btn bt-primary mt-2" id="filtros-open"><span class="fas fa-filter mr-2"></span>Filtrar</button>
</div>


<div class="d-flex mt-3 mt-sm-4">


    <div class="col-lg-9 col-md-8 p-0">
        <div class="products" id="hits">
            <!-- Hits widget will appear here -->
        </div>
            
        <div id="pagination">
            <!-- Pagination widget will appear here -->
        </div>
    </div>

    <div class="bg-filtros" id="bg-filtros"></div>

    <div id="filtros" class="col-lg-3 col-md-4 filtros p-4 p-sm-3">

        <div class="d-none d-sm-block">
            <h4 class="mt-4 mt-sm-0 mb-4 font-weight-bold">Buscar:</h4>
            <div id="search-box">
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
            Aplicar Filtros
        </button>
    </div>
    
</div>




@endsection

@section('extra-js')
    <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@2.10.4"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8=" crossorigin="anonymous"></script>
    <script src="{{ asset('js/algolia-instant.js') }}"></script>
@endsection