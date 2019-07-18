@extends('layouts.app')

@section('title', 'Home')

@section('content')

<div class="home-title p-lg-1 mb-1 mb-lg-3 d-lg-flex justify-content-between">
  <div class="order-sm-1">
      <h4 class="ml-lg-5 ml-0 mt-1 mb-2 text--darkest-grey text-center text-lg-left text-lg-center">{{ $categoryName }}</h4>
      <div class="underline d-none d-lg-block"></div>
  </div>

  <div class="order-sm-3 filters d-flex justify-content-around mr-lg-5 mt-3 mt-lg-0 mb-3 text--darkest-grey p-1">

      <div class="dropdown">
          <button class="dropdown-toggle btn bt-dropdown" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="--link"><i class="fas fa-sliders-h mr-1"> </i> Filtrar</span>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
            {{-- <a class="dropdown-item" href="{{ route('home.index', ['category'=> request()->category, 'sort'=> 'low_high']) }}">Menor Precio</a>
            <a class="dropdown-item" href="{{ route('home.index', ['category'=> request()->category, 'sort'=> 'high_low']) }}">Mayor Precio</a> --}}
          </div>
      </div>

      <div class="dropdown">
          <button class="dropdown-toggle btn bt-dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="--link"><i class="fas fa-sort mr-1"> </i> Ordenar</span>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{ route('home.index', ['category'=> request()->category, 'sort'=> 'low_high']) }}">Menor Precio</a>
            <a class="dropdown-item" href="{{ route('home.index', ['category'=> request()->category, 'sort'=> 'high_low']) }}">Mayor Precio</a>
          </div>
      </div>
  </div>


  <div class="labels-filter-order text-center flex-lg-grow-1 order-sm-2 p-lg-1 text-lg-right">
    @if (request()->sort)
    <div class="btn text--dark-grey mr-2 filter-label">
        <p class="m-0">

          @if (request()->sort == "low_high")
            <span>Menor precio</span> <a href="{{ route('home.index', ['category'=> request()->category, 'sort'=> '']) }}" class="fas fa-times del-sort"></a> 
          @elseif (request()->sort == "high_low")
            <span>Mayor precio</span> <a href="{{ route('home.index', ['category'=> request()->category, 'sort'=> '']) }}" class="fas fa-times del-sort"></a> 
          @endif
        
        </p>
      </div>
    @endif
  </div>
</div>


<div class="products container-fluid p-0 justify-content-center d-flex">

  

  @if ($products->isEmpty())
      
    <h3 class="text--darkest-grey mt-5 w-100 text-center">No hay Productos disponibles en esta Categoría (aún).</h3>
    <br>
    <p class="text--dark-grey mt-2 w-100 text-center">Estamos en continua incorporación de nuevos Proveedores. Este mensaje no durará mucho tiempo.</p>

  @else
      
    @foreach ($products as $product)

    <div class="card m-3 flex-row flex-sm-column d-block">
      <div class="text-center align-items-center d-sm-block card-img-container">
          <a href="{{ route('home.show', $product->id . "-" . $product->nombre) }}">
              <img class="card-img-top" src="{{ asset('img/products/'. $product->imagen_url) }}" alt="{{ $product->descripcion }}">
            </a>
      </div>

      
      <div class="card-body --border-top">
           <h3 class="mb-3">{{ $product->presentPrice() }}</h3>
          <div class="product-nombre mb-1">
              <h5>{{ $product->nombre }}</h5>
          </div>
          <p class="text--dark-grey card-text">{{ $product->descripcion }}<span> {{ $product->capacidad }}</span></p>
          <div class="text-sm-center">
            <a href="{{ route('home.show', $product->id . "-" . $product->nombre) }}" class="text-center btn bt-primary">Agregar al pedido</a>
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
                      <a class="dropdown-item subcategory" href="{{ route('home.index', ['category'=> $subcategory->nom_low]) }}">{{ $subcategory->nombre }}</a>
                    @endif
                  @endforeach
        
              </div>
            @endforeach
              
      </div>
      
  </div>
</div>

@endsection

@section('extra-js')

<script>

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

    
@endsection

