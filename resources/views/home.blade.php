@extends('layouts.app')

@section('title', 'Inicio')

@section('content')

<div class="home-title p-lg-1 mb-3">
  <div class="order-sm-1 mt-1 p-1 ml-4 mb-3 ml-4">
      <h2 class=" mt-1 mb-2 text--darkest-grey">{{ $categoryName }}</h2>
      <div class="underline m-0"></div>
  </div>

  {{-- <div class="order-sm-3 filters d-flex justify-content-around mr-lg-5 mt-3 mt-lg-0 mb-3 text--darkest-grey p-1">

      <div class="dropdown">
          <button class="dropdown-toggle btn bt-dropdown" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="--link"><i class="fas fa-sort mr-1"> </i> Ordenar</span>
          </button>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="{{ route('home.index', ['category'=> request()->category, 'sort'=> 'low_high']) }}">Menor Precio</a>
            <a class="dropdown-item" href="{{ route('home.index', ['category'=> request()->category, 'sort'=> 'high_low']) }}">Mayor Precio</a>
          </div>
      </div>
  </div> --}}


  {{-- <div class="labels-filter-order text-center flex-lg-grow-1 order-sm-2 p-lg-1 text-lg-right">
    @if (request()->sort)
    <div class="btn text--dark-grey mr-2 filter-label">
        <p class="m-0">

          @if (request()->sort == "low_high")
            <span>Menor precio</span> <a href="{{ route('home.index', ['category'=> request()->category, '']) }}" class="fas fa-times del-sort"></a> 
          @elseif (request()->sort == "high_low")
            <span>Mayor precio</span> <a href="{{ route('home.index', ['category'=> request()->category, '']) }}" class="fas fa-times del-sort"></a> 
          @endif
        
        </p>
      </div>
    @endif
  </div>
</div> --}}


<div class="products container-fluid p-0 justify-content-center d-flex">

  @if ($products->isEmpty())
      
    <h4 class="text--darkest-grey mt-5 w-100 text-center">No se encontraron Productos.</h4>
    <br>
    <p class="text--dark-grey mt-2 w-100 text-center">Estamos en continua incorporación de nuevos Proveedores. Este mensaje no durará mucho tiempo.</p>

  @else
      
    @foreach ($products as $product)

    <div class="card m-3 flex-row flex-sm-column d-block">
      <div class="text-center align-items-center d-sm-block card-img-container">
          <a href="{{ route('home.show', $product->nombre) }}">
              <img class="card-img-top" src="{{ asset('storage/'. $product->imagen_url) }}" alt="{{ $product->descripcion_breve }}">
            </a>
      </div>

      
      <div class="card-body --border-top">
           <h3 class="mb-3">{{ $product->presentPrice() }}</h3>
          <div class="product-nombre mb-1">
              <h5>{{ $product->nombre }}</h5>
          </div>
          <p class="text--dark-grey card-text">{{ $product->descripcion_breve }}<span> - {{ $product->capacidad }}</span></p>
          <div class="text-sm-center">
            <a href="{{ route('home.show', $product->nombre) }}" class="text-center btn bt-primary">Agregar al pedido</a>
          </div>
      </div>
    </div>
    
    @endforeach
  @endif
 
</div>

<div class="d-flex justify-content-center mt-4 mb-4">
  {{ $products->appends(request()->input())->links() }}
</div>


@endsection


