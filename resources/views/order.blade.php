@extends('layouts.appP')

@section('title', 'Pedido ' . $order->id)

@section('content')

<div class="cart card">
    <div class="mb-4 mt-2 p-1 ml-2">
    <h2 class="ml-0 mt-1 mb-2 text--darkest-grey">Detalles del pedido #{{$order->id}}</h2>
        <div class="underline m-0 l-1"></div>
    </div>


    <div>
        <p>Código de pedido: #{{$order->id}}</p>

        <p>Pedido por: {{ $merchant->nombre }}</p>
        
        <p>Establecimiento: {{ $establishment->nombre }}</p>

        <p>Cantidad de productos únicos: {{ count($products) }}</p>

        <br>
        @foreach ($products as $product)
            
            <p>Producto id: {{ $product->id }}</p>
            <p>Producto nombre: {{ $product->nombre }}</p>
            <p>Producto marca: {{ $product->marca }}</p>
            <p>Producto cant: 
                @foreach ($orderProducts as $item)
                    
                    @if ($item->product_id == $product->id)
                        {{ $item->cantidad }}
                    @endif

                @endforeach
            </p>
            <p>Producto precio unitario: {{ presentPrice($product->precio) }}</p>
            <br>
        @endforeach
        <br>
        
        <p>Descuentos: {{ presentPrice($order->descuentos) }}</p>

        <p>Total: {{ presentPrice($order->subtotal) }}</p>

    </div>
</div>

@endsection