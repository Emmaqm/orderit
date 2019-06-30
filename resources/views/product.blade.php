@extends('layouts.app')

@section('title', $product->nombre)

@section('content')

<div class="product container-fluid p-0 justify-content-center d-flex">

    <div class="container">
        <div class="row">
          <div class="col-10 col-sm-6 col-xl-6 col-lg-6 product-left">
            <div class="text-center product-image-wrapper --white-container">
                <img class="img-fluid" src="{{ asset('img/products/'. $product->imagen_url) }}" alt="{{ $product->descripcion }}">
            </div>
          </div>
          <div class="mt-3 col-10 col-sm-6 col-xl-6 col-lg-6 pl-4 product-right">
            <h2 class="text--darkest-grey">{{ $product->nombre }}</h2>
            <p class="text--dark-grey">Vendido por: <a class="--link" href="#">{{ $product->marca }}</a></p>
            <p class="product-price">{{ $product->presentPrice() }}</p>
            <p class="text--darkest-grey product-desc">{{ $product->descripcion }}</p>
           
            <form action="{{ route('cart.store', $product) }}" method="POST">
                @csrf
                <div class="form-group row product-form">
                    <label for="cantidad-producto" class="text--dark-grey col-form-label cant-label">Cantidad:</label>
                    <select class="form-control cantidad" name="selectCantidad">
                        @for ($i = 1; $i < 11; $i++)
                            <option>{{$i}}</option>
                        @endfor
                    </select>
                    <div class="col-12">
                        <button type="submit" class="text-center btn bt-primary product-btn">Agregar a mi pedido</button>
                    </div>
                </div>
            </form>
            
          </div>
        </div>


        @include('partials.alsoLike')
    </div>


@endsection

