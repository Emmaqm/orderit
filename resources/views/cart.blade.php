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
                <select class="form-control cantidad" name="selectCantidad" data-id="{{ $product->rowId }}">
                    @for ($i = 1; $i < 11; $i++)
                        <option {{ $product->qty == $i ? 'selected' : ''}}>{{$i}}</option>
                    @endfor
                </select>
            </div>

            <div class="d-flex align-items-center pl-4 ml-1">
                <h5 class="product-price m-0 mb-2">{{ presentPrice($product->subtotal) }}</h5>
            </div>
           
        </div>
    @endforeach


    @if (Cart::count() > 0)

        <div class="totales mt-4">

            <div class="prices text-right ml-2 mr-2 mt-2 mb-4 pt-4 pb-4 pr-4">
                <div class="column-label">
                    <p class="mr-4 text--dark-grey">Descuentos</p>
                    <h4 class="mr-4 text--darkest-grey">Total</h4>
                </div>

                <div class="column-prices">
                    <p>$9.00</p>
                    <h4>{{ presentPrice(Cart::total()) }}</h4> 
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a class="ml-3 mt-1 btn-link" href="{{ route('home.index') }}"><i class="fas fa-arrow-left mr-2"></i>Seguir Comprando</a>

                <a class="mr-2 bt-primary btn text-right" href="#">Finalizar mi Pedido</a>
            </div>
        </div>

    @else

        <div class="d-flex justify-content-between">
            <a class="ml-2 mt-1 btn-link" href="{{ route('home.index') }}"><i class="fas fa-arrow-left mr-2"></i>Seguir Comprando</a>
        </div>

    @endif


</div>

@endsection


@section('extra-js')
    <script>
        (function(){
            var className = document.querySelectorAll('.cantidad');

            Array.from(className).forEach(function(element){
                element.addEventListener('change', function(){
                    const id = element.getAttribute('data-id');
                    axios.patch(`/pedido/${id}`, {
                        cantidad: this.value
                    })
                    .then(function (response) {
                        window.location.href = ' {{ route('cart.index') }} '
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
                })
            })
        })();
    </script>
@endsection