@extends('layouts.app')

@section('title', 'Resultados de la búsqueda')

@section('extra-css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/instantsearch.js@2.10.4/dist/instantsearch.min.css">   
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/instantsearch.js@2.10.4/dist/instantsearch-theme-algolia.min.css">
@endsection

@section('content')

<div>
    <h4 class="ml-lg-5 ml-0 mt-1 mb-2 text--darkest-grey">{{ app('request')->input('query') }}</h4>
                                                                                             
    <div class="underline d-none d-lg-block"></div>
</div>

<div id="search-box">
    <!-- SearchBox widget will appear here -->
</div>

<div id="refinement-list">
  <!-- RefinementList widget will appear here -->
</div>

<div class="products" id="hits">
    <!-- Hits widget will appear here -->
</div>

<div id="pagination">
    <!-- Pagination widget will appear here -->
</div>

@endsection

@section('extra-js')
    <script src="https://cdn.jsdelivr.net/npm/instantsearch.js@2.10.4"></script>
    <script src="{{ asset('js/algolia-instant.js') }}"></script>
@endsection