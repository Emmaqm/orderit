@extends('layouts.app')

@section('title', 'Mis pedidos')

@section('content')
    
@section('content')
    
<div class="card card-proveedor w-100">
    <div class="mb-2 mt-2 p-1 ml-2">
        <h2 class="ml-0 mt-1 mb-2 text--darkest-grey">Mis Pedidos</h2>
        <div class="underline m-0 l-1"></div>
    </div>
    
    <div class="m-2">    
    </div>

    <div class="d-flex justify-content-center pt-0 pb-4">

        <div class="mr-2" style="cursor:pointer">
            <h5 class="text--darkest-grey px-3 btn1">No entregados</h5>
            <div style="height: 3px" class="underline under1 m-0 w-100"></div>
        </div>

        <div class="ml-2" style="cursor:pointer">
            <h5 class="text--darkest-grey px-3 btn2">Entregados</h5>
            <div style="height: 3px" class="underline under2 m-0 w-100"></div>
        </div>

    </div>

    <div>
        <div id="tabla1">
            <table id="pedidos2-table" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Detalles</th>
                            <th>Seguimiento</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>{{ presentPrice($order->subtotal) }}</td>
                                <td class="text-center" style="vertical-align:middle;"> <a class="btn bt-primary bt-detalles" style="" href="{{ route('order.details', $order->id) }}">Ver detalles</a> </td>
                                <td class="text-center" style="vertical-align:middle;"> <a href="{{ route('order.trackingDetails', $order->id) }}">¿Donde está mi pedido?</a> </td>
                            </tr>
                        @endforeach
                    </tbody>
                  
            </table>
        </div>
    
    
        <div id="tabla2">
            <table id="pedidos-table" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Fecha</th>
                            <th>Total</th>
                            <th>Detalles</th>
                            <th>Seguimiento</th>
                        </tr>
                    </thead>
                   
            </table>
        </div>
    </div>
</div>

@endsection

@section('extra-js')

<script>

    $(document).ready( function () {
        $('#pedidos-table').DataTable({
            "info":false,
            "scrollX":true,
            "language": {
                "emptyTable": "No hay pedidos disponibles",
                "search": "Buscar:",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Siguiente"
                },
                "lengthMenu": "Mostrar  _MENU_ resultados por página",
            }

        });
    });

    $(document).ready( function () {
        $('#pedidos2-table').DataTable({
            "info":false,
            "scrollX":true,
            "language": {
                "emptyTable": "No hay pedidos disponibles",
                "search": "Buscar:",
                "paginate": {
                    "previous": "Anterior",
                    "next": "Siguiente"
                },
                "lengthMenu": "Mostrar  _MENU_ resultados por página",
            }

        });
    });


    $(document).ready( function(){

        $('#tabla2').hide();
        $('#tabla2').css('visibility', 'visible');

        $('.btn2').click( function(){
            $('#tabla1').fadeOut( 250, function() {
                $('#tabla2').fadeIn();
            });
            $('.under1').fadeOut( 200, function() {
                $('.under2').fadeIn();
            });         
        })

        $('.btn1').click( function(){
            $('#tabla2').fadeOut( 250, function() {
                $('#tabla1').fadeIn();
            });
            $('.under2').fadeOut( 200, function() {
                $('.under1').fadeIn();
            });         
        })
    });
</script>

<style>

.dataTables_scroll{
    margin-bottom: 1.5rem;
}


#tabla2{
    visibility: hidden;
}

.dataTables_scrollHeadInner{
    width: unset !important;
}

div.dataTables_scrollHead table.table-bordered{
    width: unset !important;
}

.under2{
    display: none;
}

.table .bt-detalles:hover{
    background-color: transparent;
}

</style>

@endsection

@endsection