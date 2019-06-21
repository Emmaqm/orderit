@extends('layouts.app')

@section('title', 'Home')

@section('content')

<div class="products container-fluid p-0 justify-content-center d-flex">
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
</div>

@endsection


