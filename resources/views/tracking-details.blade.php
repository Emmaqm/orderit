@extends('layouts.app')

@section('title', 'Estado del pedido')

@section('content')

<div class="cart card">
    <div class="container">

		<div class="mb-2 mt-2 p-1 ml-2">
			<h2 class="ml-0 mt-1 mb-2 text--darkest-grey">Estado del pedido #{{$order->id}}</h2>
			<div class="underline m-0 l-1"></div>
		</div>

		<div class="px-3 pt-4 pb-2">

			<h4 class="px-4 py-3 text--darkest-grey" style="background-color:#f5f5f5">Datos Generales</h4>
			
			<div class="d-flex flex-wrap">
	
				<div class="p-3 pb-0">
					<p>Código de pedido: </p> <h5> #{{$order->id}}</h5>
				</div>
	
				<div class="p-3 pb-0 ml-0 ml-sm-3">
					<p>Fecha del pedido: </p><h5>{{$date}}</h5>
				</div>            
	
	
				<div class="p-3 pb-0 ml-0 ml-sm-3">
					<p>Pedido por: </p> <h5>{{ $merchant->nombre . " " . $merchant->apellido }}</h5>
				</div>
	
	
				<div class="p-3 pb-0 ml-0 ml-sm-3">
					<p>Total: </p> <h5>{{ presentPrice($order->subtotal) }}</h5>
				</div>
	
			</div>
		
		</div>
		
		<div class="px-3 pt-4 pb-2">
			<h4 class="px-4 py-3 text--darkest-grey" style="background-color:#f5f5f5">Estado</h4>
		</div>
		
        <div class="row">
                 <div class="col-12 col-md-10 hh-grayBox">
                     <div class="row justify-content-sm-between justify-content-center flex-column flex-sm-row">
                         <div class="order-tracking {{ ($estado !=0 ) ? 'completed' : '' }} mx-auto mx-sm-0 py-sm-0 py-3">
                             <span class="is-complete"></span>
                             <p>Pedido realizado</p>
                         </div>
                         <div class="order-tracking {{ ($estado == 2 or $estado == 3 or $estado == 4 or $estado == 5 ) ? 'completed' : '' }} mx-auto mx-sm-0 py-sm-0 py-3">
                             <span class="is-complete"></span>
                             <p>Procesando por<br>los proveedores</p>
                         </div>
                         <div class="order-tracking {{ ($estado == 3 or $estado == 4 or $estado == 5 ) ? 'completed' : '' }} mx-auto mx-sm-0 py-sm-0 py-3">
                             <span class="is-complete"></span>
                             <p>En centro de<br>logística Orderit</p>
                         </div>
                         <div class="order-tracking {{ ($estado == 4 or $estado == 5 ) ? 'completed' : '' }} mx-auto mx-sm-0 py-sm-0 py-3">
                             <span class="is-complete"></span>
                             <p>Pronto para<br>enviar</p>
                         </div>
                         <div class="order-tracking {{ ($estado == 5) ? 'completed' : '' }} mx-auto mx-sm-0 py-sm-0 py-3">
                             <span class="is-complete"></span>
                             <p>Entregado</p>
                         </div>
                     </div>
                 </div>
             </div>
	  </div>
	  
	<div class="d-flex justify-content-between my-4 ml-4">
		<a class="ml-3 mt-1 btn-link" href="{{ route('order.indexM') }}"><i class="fas fa-arrow-left mr-2"></i><span class="d-sm-inline d-none">Volver</span></a>	
	</div>
</div>

@endsection

@section('extra-js')

@endsection


<style>
.hh-grayBox {
	margin: 0 auto;
	margin-top: 40px;
	margin-bottom: 40px;
	padding:0 !important;
}
.order-tracking{
	text-align: center;
	width: 33.33%;
	position: relative;
	display: block;
}
.order-tracking .is-complete{
	display: block;
	position: relative;
	border-radius: 50%;
	height: 30px;
	width: 30px;
	border: 0px solid #AFAFAF;
	background-color: #F6E05E;
	margin: 0 auto;
	transition: background 0.25s linear;
	-webkit-transition: background 0.25s linear;
	z-index: 2;
}
.order-tracking .is-complete:after {
	display: block;
	position: absolute;
	content: '';
	height: 14px;
	width: 7px;
	top: -2px;
	bottom: 0;
	left: 5px;
	margin: auto 0;
	border: 0px solid #AFAFAF;
	border-width: 0px 2px 2px 0;
	transform: rotate(45deg);
	opacity: 0;
}
.order-tracking.completed .is-complete{
	border-color: #68D391;
	border-width: 0px;
	background-color: #68D391;
}
.order-tracking.completed .is-complete:after {
	border-color: #fff;
	border-width: 0px 3px 3px 0;
	width: 7px;
	left: 11px;
	opacity: 1;
}
.order-tracking p {
	color: #A4A4A4;
	font-size: 16px;
	margin-top: 8px;
	margin-bottom: 0;
	line-height: 20px;
}
.order-tracking p span{font-size: 14px;}
.order-tracking.completed p{color: #000;}
.order-tracking::before {
	content: '';
	display: block;
	height: 3px;
	width: calc(100% - 40px);
	background-color: #F6E05E;
	top: 13px;
	position: absolute;
	left: calc(-50% + 20px);
	z-index: 0;
}
.order-tracking:first-child:before{display: none;}
.order-tracking.completed:before{background-color: #68D391;}

.row{
	flex-wrap: unset !important;
}

@media (max-width: 575px){
	.hh-grayBox{
		margin-top: 10px;
	}

	.order-tracking::before{
		display: none;
	}
}


</style>