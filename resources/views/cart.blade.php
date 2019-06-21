@extends('layouts.app')

@section('title', 'Mi Pedido')

@section('content')

<div class="cart justify-content-center">

    @if (session()->has('success_message'))
        <div class="alert alert-success" role="alert">
            {{ session()->get('success_message')}}
        </div>

    @endif


    @if (Cart::count() > 0)

        <h4 class="pb-3 pl-3 pt-2 text--dark-grey">{{ Cart::count() }} producto(s) en su Pedido</h4>
        
    @else

        <p class="m-0 alert alert-primary" role="alert">No tiene productos en su Pedido</p>
        <br>
        <a class="btn bt-secondary" href="{{ route('home.index') }}">Continuar comprando</a>

    @endif


    @foreach (Cart::content() as $product)
        <div class="row cart-row pl-4 pr-4 mt-3">
           
            <div class="cart-product-image">
                <a href="{{ route('home.show', $product->model->id . "-" . $product->model->nombre) }}">
                    <img src="{{ asset('img/products/'. $product->model->imagen_url) }}" alt="{{ $product->model->nombre}} ">
                </a>
            </div>

            <div class="pl-4 pt-4 cart-product-name">
                <a href="{{ route('home.show', $product->model->id . "-" . $product->model->nombre) }}">
                    <h4 class="text--darkest-grey">{{ $product->model->nombre }}</h4>
                </a>
                
            
                <form class="remove-btn" action="{{ route('cart.destroy', $product->rowId) }}" method="POST">
                    @csrf
                    @method('DELETE')
                
                    <button type="submit">Eliminar</button>
                </form>
            </div>




            <div class="d-flex align-items-center pl-5 ml-5">
                <input id="cantidad-producto" class="form-control" type="number" value="1" min="1" max="20">
            </div>

            <div class="d-flex align-items-center pl-4">
                <p class="product-price">{{ $product->model->presentPrice() }}</p>
            </div>
           
        </div>
    @endforeach

    <div class="totales">
        Total {{ presentPrice(Cart::total()) }}

    </div>

</div>

@endsection


