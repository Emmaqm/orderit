@extends('layouts.app')

@section('title', 'Home')

@section('content')

<div class="home-title mb-3 d-flex justify-content-between">
  <div>
      <h2 class="ml-5 mt-1 mb-2 text--darkest-grey">{{ $categoryName }}</h2>
      <span class="underline"></span>
  </div>

  <div class="d-flex mr-5 mt-1 mb-2 text--darkest-grey" style="padding:3px;">

      @if (request()->sort)
      <div class="btn text--dark-grey mr-2" style="border: 1px solid rgba(0,0,0,0.1)">
          <p class="m-0">Filtro: 
  
            @if (request()->sort == "low_high")
              <span class="ml-1">Menor precio</span> <a href="{{ route('home.index') }}" class="fas fa-times del-sort"></a> 
            @elseif (request()->sort == "high_low")
              <span class="ml-1">Mayor precio</span> <a href="{{ route('home.index') }}" class="fas fa-times del-sort"></a> 
            @endif
          
          </p>
        </div>
      @endif


      <div class="dropdown">
          <button class="dropdown-toggle btn bt-dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Ordenar por precio
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{ route('home.index', ['category'=> request()->category, 'sort'=> 'low_high']) }}">Menor Precio</a>
            <a class="dropdown-item" href="{{ route('home.index', ['category'=> request()->category, 'sort'=> 'high_low']) }}">Mayor Precio</a>
          </div>
        </div>
  </div>

</div>


<div class="products container-fluid p-0 justify-content-center d-flex">

  

  @if ($products->isEmpty())
      
    <h3 class="text--darkest-grey mt-5 w-100 text-center">No hay Productos disponibles en esta Categoría (aún).</h3>
    <br>
    <p class="text--dark-grey mt-2 w-100 text-center">Estamos en continua incorporación de nuevos Proveedores. Este mensaje no durará mucho tiempo.</p>

  @else
      
    @foreach ($products as $product)

    <div class="card m-3">
      <a href="{{ route('home.show', $product->id . "-" . $product->nombre) }}">
        <img class="card-img-top" src="{{ asset('img/products/'. $product->imagen_url) }}" alt="{{ $product->descripcion }}">
      </a>
      
      <div class="card-body --border-top">
      <h3 class="mb-3">{{ $product->presentPrice() }}</h3>
        <h5>{{ $product->nombre }}</h5>
        <p class="text--dark-grey card-text">{{ $product->descripcion }}<span> {{ $product->capacidad }}</span></p>
        <div class="text-center">
          <a href="{{ route('home.show', $product->id . "-" . $product->nombre) }}" class="text-center btn bt-primary">Agregar a mi pedido</a>
        </div>
      </div>
    </div>
    
    @endforeach
  @endif

  
</div>

@endsection


@section('categories')
<div class="dropdown show dropright">
  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-th-large"></i>
      <p>Categorías</p>
  </a>

  <div class="dropdown-menu p-0" aria-labelledby="dropdownMenuLink">

      <div class="d-flex">
          <div class="categories --back-color-secondary">
            @foreach ($categories as $category)
              <a id="{{ $category->nom_low }}" class="category dropdown-item" href="#">{{ $category->nombre }}</a>
            @endforeach
          </div>
            
            @foreach ($categories as $category)
              <div id="{{ $category->nom_low }}-items" class="subcategories">
                  @foreach ($subcategories as $subcategory)
                    @if ($subcategory->category_id == $category->id)
                      <a class="dropdown-item" href="{{ route('home.index', ['category'=> $subcategory->nom_low]) }}">{{ $subcategory->nombre }}</a>
                    @endif
                  @endforeach
        
              </div>
            @endforeach
              
      </div>
      
  </div>
</div>
@endsection

