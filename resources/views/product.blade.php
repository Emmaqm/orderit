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
          <div class=" col-10 col-sm-6 col-xl-6 col-lg-6 pl-4 product-right">
            <h2 class="text--darkest-grey">{{ $product->nombre }}</h2>
            <p class="text--dark-grey">Vendido por: <a class="--link" href="#">{{ $product->marca }}</a></p>
            <p class="product-price">{{ $product->presentPrice() }}</p>
            <p class="text--darkest-grey product-desc">{{ $product->descripcion }}</p>
           
            <form>
                <div class="form-group row product-form">
                    <label for="cantidad-producto" class="text--dark-grey col-form-label cant-label">Cantidad:</label>
                    <div class="cant-wrapper">
                      <input id="cantidad-producto" class="form-control" type="number" value="1" min="1" max="20">
                    </div>
                    <div class="col-12">
                        <button type="submit" class="text-center btn bt-primary product-btn">Agregar a mi pedido</button>
                    </div>
                </div>
            </form>
            
          </div>
        </div>


        <div class="row">
          <div class="col-12">
              
            <div class="also-like --white-container">
            <h3 class="text-center text--darkest-grey">Otros productos que te pueden interesar</h3>
              <div class="d-flex justify-content-center">
                  
                  @foreach ($alsoLike as $product)

                    <div class="card m-3">
                        <a href="{{ route('home.show', $product->nombre) }}">
                          <img class="card-img-top" src="{{ asset('img/products/'. $product->imagen_url) }}" alt="{{ $product->descripcion }}">
                        </a>
                        
                        <div class="card-body --border-top text-center">
                          <h5 class="card-title">{{ $product->nombre }}</h5>
                          <p class="card-title text--dark-grey">{{ $product->presentPrice() }}<span> c/u</span></p>
                          <div class="text-center">
                            <a href="{{ route('home.show', $product->nombre) }}" class="text-center --link">Ver más</a>
                          </div>
                        </div>
                    </div>
                        
                  @endforeach
                


              </div>
            </div>
          </div>
        </div>
    </div>


@endsection

