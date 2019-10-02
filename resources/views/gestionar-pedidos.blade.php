@extends('layouts.appP')

@section('title', 'Gestionar Pedidos')        

@section('content')
    
<table id="pedidos-table" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Código de Pedido</th>
            <th>Descuentos</th>
            <th>Total</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)

            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ presentPrice($order->descuentos) }}</td>
                <td>{{ presentPrice($order->subtotal) }}</td>
                <td><a href="{{ route('order.show', $order->id) }}">Procesar</a></td>
            </tr>

        @endforeach

    </tbody>
</table>

@endsection

@section('extra-css')

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/w/bs4/dt-1.10.18/datatables.min.css"/>
  
@endsection

@section('extra-js')

<script>
    $(document).ready( function () {
        $('#pedidos-table').DataTable();
    } );

</script>

@endsection
