@extends('layouts.appP')

@section('title', 'Pedido ' . $order->id)

@section('content')

<div class="cart card">
    <div class="mb-2 mt-2 p-1 ml-2">
    <h2 class="ml-0 mt-1 mb-2 text--darkest-grey">Detalles del pedido #{{$order->id}}</h2>
        <div class="underline m-0 l-1"></div>
    </div>

    @if (session()->has('success_message'))
        <div class="alert alert-success my-3 mx-4" role="alert">
            {{ session()->get('success_message')}}
        </div>

    @endif

    <div>

        <div class="px-4 pt-4 pb-2">

            <h4 class="px-4 py-3 text--darkest-grey" style="background-color:#f5f5f5">Datos Generales</h4>
            
            <div class="d-flex flex-wrap">

                <div class="p-3 pb-0">
                    <p>Código de pedido: </p> <h5> #{{$order->id}}</h5>
                </div>

                <div class="p-3 pb-0 ml-0 ml-sm-3">
                    <p>Cant. de prod. únicos: </p> <h5>{{ count($products) }}</h5>
                </div>            
    

                <div class="p-3 pb-0">
                    <p>Pedido por: </p> <h5>{{ $establishment->nombre }}</h5>
                </div>

                <div class="p-3 pb-0 ml-0 ml-sm-3">
                    <p>Usuario: </p> <h5>{{ $merchant->nombre . " " . $merchant->apellido }}</h5>
                </div>

            </div>
        
        </div>
       
        <div class="p-4">

            <h4 class="px-4 py-3 mb-4 text--darkest-grey" style="background-color:#f5f5f5">Productos</h4>

            <table id="detalles-table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Código del producto</th>
                        <th>Nombre</th>
                        <th>Marca</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
            
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td> {{ $product->nombre }}</td>
                            <td> {{ $product->marca }}</td>
                            <td class="text-right">
                                @foreach ($orderProducts as $item)
                                    
                                    @if ($item->product_id == $product->id)
                                        {{ $item->cantidad }}
                                        @php
                                            $sub = $product->precio * $item->cantidad
                                        @endphp 
                                    @endif
                    
                                @endforeach
                            </td>
                            <td class="text-right"> {{ presentPrice($product->precio) }}</td>
                            <td class="text-right">{{ presentPrice($sub) }}</td>
                        </tr>
            
                    @endforeach
            
                </tbody>
            </table>
        
            <div class="p-4 prices text-right mt-4 mt-2 pt-sm-4 pt-3 pt-sm-4 pb-3 pr-4 d-flex justify-content-end" style="background-color: #f5f5f5;">

                <div>
                    <p class="my-2 mr-4">Descuentos:</p> 
                    <p class="my-2 mr-4 mt-3">Total:</p> 
                </div>

                <div>
                    <h5 class="my-2">{{ presentPrice($order->descuentos) }}</h5>
                
                    <h5 class="my-2 mt-3">{{ presentPrice($order->subtotal) }}</h5>
                </div>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <a class="ml-3 mt-1 btn-link" href="{{ route('order.index') }}"><i class="fas fa-arrow-left mr-2"></i><span class="d-sm-inline d-none">Volver</span></a>
                
                @if ($estado == "Procesando")
                     <form action="{{ route('order.changeStateReadyToShip', ['orderId' => $order->id, 'supplierId' =>  Auth::user()->id_comercio]) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <button type="submit" class="mr-2 bt-primary btn text-right"><i class="fas fa-check mr-2"></i>Marcar como listo para retirar</button> 
                   </form>   
                @endif

                
            </div>
        </div>
        


    </div>
</div>

@endsection

@section('extra-js')
    <script>
        $(document).ready( function () {
            $('#detalles-table').DataTable({
                "paging":false,
                "info":false,
                "scrollX":true,
                "oLanguage": {
                    "sSearch": "Buscar:"
                }
            });
        } );
    
    </script>

@endsection