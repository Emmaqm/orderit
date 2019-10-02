@extends('layouts.empty')

@section('title', 'Cuenta pendiente de activación')

@section('content')

    @if ($status == 'approved')

        <div class="card p-4 col-lg-8 mx-auto">
            <div class="mb-4 mt-2 p-1 ml-2">
                <h2 class="ml-0 mt-1 mb-2 text--darkest-grey">Mi Pedido</h2>
                <div class="underline m-0 l-1"></div>
            </div>
    
     
            <div class="alert alert-success" role="alert">
                ¡Pedido realizado con éxito!
            </div>
    
            <div class="ml-1 mt-2">
                <p class="font-weight-bold">Podrá ver el estado de su pedido en la pestaña <a href="#">"Mis pedidos"</a> identificado con el código: {{ $order_id }} </p>
            </div>
    
            <a class="ml-1 mt-4 btn-link" href="{{ route('home.index') }}">
                <i class="fas fa-arrow-left mr-2"></i><span>Volver al Inicio</span>
            </a>
        </div>
        
    @else


        <div class="card p-4 col-lg-8 mx-auto">
            <div class="mb-4 mt-2 p-1 ml-2">
                <h2 class="ml-0 mt-1 mb-2 text--darkest-grey">Mi Pedido</h2>
                <div class="underline m-0 l-1"></div>
            </div>
    
    
            <div class="alert alert-danger" role="alert">
                Su pedido no se ha podido realizar
            </div>
    
            <div class="ml-1 mt-2">
                <p class="font-weight-bold">Por favor verifique su medio de pago y vueva a intentarlo.</p>
            </div>
    
            <a class="ml-1 mt-4 btn-link" href="{{ route('home.index') }}">
                <i class="fas fa-arrow-left mr-2"></i><span>Volver al Inicio</span>
            </a>
        </div>
    @endif


@endsection