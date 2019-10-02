@extends('layouts.app')

@section('title', 'Confirmación del Pedido')

@section('content')

<div class="cart mx-auto mt-4" style="max-width:650px">

    <div class="mb-4 mt-2 p-1 ml-2">
        <h2 class="ml-0 mt-1 mb-2 text--darkest-grey">Confirmación del Pedido</h2>
        <div class="underline m-0 l-1"></div>
    </div>

    @if (Cart::count() > 0)

        <div class="alert alert-primary" role="alert">
            <i class="fas fa-info-circle mr-1"></i> Verifique su pedido antes de continuar con el pago.
        </div>

    @endif


    @if (Cart::count() == 0)

        <p class="m-0 alert alert-warning" role="alert">No tiene productos en su Pedido</p>
        <br>

    @endif


    @foreach (Cart::content() as $product)
        <div class="row cart-row pl-4 pr-4 mt-3 justify-content-between flex-sm-nowrap">
           
            <div class="d-flex">
                <div class="cart-product-image">
                    <img style="max-height: 80px; max-width: 90px;" src="{{ asset('storage/'. $product->model->imagen_url) }}" alt="{{ $product->model->nombre}} ">
                </div>
    
                <div class="cart-product-name ml-sm-4 ml-3 pt-2 pt-sm-2 mr-sm-4 mr-2">
  
                    <h5 class="text--darkest-grey">{{ $product->model->nombre }}</h5>
      
                    
                    <div class="d-flex align-items-center">
                            <p class="m-0 mb-2 mr-2 text--dark-grey">Cantidad:</p>  <p class="text--darkest-grey font-weight-bold product-price m-0 mb-2">{{ $product->qty }}</p>
                     </div>

                </div>
            </div>


            <div class="pt-2 pt-sm-4 justify-content-end mr-2">
        
                <div class="d-flex align-items-center pl-sm-4">
                    <h5 class="product-price m-0 mb-2">{{ presentPrice($product->subtotal) }}</h5>
                </div>

            </div>
  
        </div>
    @endforeach


    @if (Cart::count() > 0)

        <div class="totales mt-4">

            <div class="prices text-right ml-2 mr-2 mt-2 mb-4 pt-sm-4 pt-3 mb-sm-4 pt-sm-4 pb-3 pr-4">
                <div class="column-label">
                    {{-- <p class="mr-4 text--dark-grey">Descuentos</p> --}}
                    <h4 class="mr-4 text--darkest-grey">Total</h4>
                </div>

                <div class="column-prices">
                    {{-- <p>$9.00</p> --}}
                    <h4>{{ presentPrice(Cart::total()) }}</h4> 
                </div>
            </div>

            <div class="d-flex justify-content-between">
                <a class="ml-3 mt-1 btn-link" href="{{ route('home.index') }}"><i class="fas fa-arrow-left mr-2"></i><span class="d-sm-inline d-none">Seguir Comprando</span></a>

                <form action="/procesar-pago" method="POST">
                    <script
                     src="https://www.mercadopago.com.uy/integrations/v1/web-payment-checkout.js"
                     data-preference-id="{{ $preference->id }}" data-header-color="#EF684A" data-elements-color="#f3431c" data-button-label="Finalizar Pedido">
                    </script>
                </form>
            </div>
        </div>

    @else

        <div class="d-flex justify-content-between">
            <a class="ml-2 mt-1 btn-link" href="{{ route('home.index') }}"><i class="fas fa-arrow-left mr-2"></i>Seguir Comprando</a>
        </div>

    @endif


</div>


@endsection