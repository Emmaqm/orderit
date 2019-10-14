@extends('layouts.appP')

@section('title', 'Dashboard')


@section('content')

<div class="d-lg-flex justify-content-between align-items-top">
    <div class="mt-2 p-1 ml-4">
        <h2 class="ml-0 mt-1 mb-2 text--darkest-grey">Dashboard</h2>
        <div class="underline m-0 l-1"></div>
    </div>

    <div class="mr-0 mr-sm-2 px-2 px-sm-4">
        
        <form action="{{ route('dashboard.index') }}" method="GET">
            <div class="form-group d-flex mt-4 mt-lg-2 justify-content-sm-end justify-content-center">
                <div class="mr-2 mr-sm-4">
                    <label for="yearSelect">Año</label>
                    <select class="form-control m-0" style="padding: 8px 10px;" id="yearSelect" name="year">
                        <option value="ally" {{ Request()->year == '' ? 'selected' : '' }}>Todos</option>
                        @for ($i = now()->year; $i > 2018 ; $i--)
                            <option value="{{ $i }}" {{ Request()->year == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>

                <div>
                    <label for="monthSelect">Mes</label>
                    <select class="form-control m-0" style="padding: 8px 10px;" id="monthSelect" name="month">
                          <option value="allm" {{ Request()->month == '' ? 'selected' : '' }}>Todos</option>
                          <option value="1" {{ Request()->month == '1' ? 'selected' : '' }}>Enero</option>
                          <option value="2" {{ Request()->month == '2' ? 'selected' : '' }}>Febrero</option>
                          <option value="3" {{ Request()->month == '3' ? 'selected' : '' }}>Marzo</option>
                          <option value="4" {{ Request()->month == '4' ? 'selected' : '' }}>Abril</option>
                          <option value="5" {{ Request()->month == '5' ? 'selected' : '' }}>Mayo</option>
                          <option value="6" {{ Request()->month == '6' ? 'selected' : '' }}>Junio</option>
                          <option value="7" {{ Request()->month == '7' ? 'selected' : '' }}>Julio</option>
                          <option value="8" {{ Request()->month == '8' ? 'selected' : '' }}>Agosto</option>
                          <option value="9" {{ Request()->month == '9' ? 'selected' : '' }}>Setiembre</option>
                          <option value="10" {{ Request()->month == '10' ? 'selected' : '' }}>Octubre</option>
                          <option value="11" {{ Request()->month == '11' ? 'selected' : '' }}>Noviembre</option>
                          <option value="12" {{ Request()->month == '12' ? 'selected' : '' }}>Diciembre</option>
                    </select>
                </div>

                <button class="btn bt-primary align-self-end ml-2 ml-sm-4" type="submit" style="padding: 6px 20px; border-radius: 4px;"><span class="fas fa-filter mr-2 d-none d-sm-inline"></span>Filtrar</button>
            </div>
        </form>
    </div>
</div>


<div class="px-4 container-fluid">

    <div class="row d-flex justify-content-between">
        <div class="p-lg-4 px-2 py-4 col-sm-4">
            <div class="card p-4">
                <p class="text--dark-grey">Productos Vendidos</p>
                <div class="d-flex justify-content-between mt-3 px-2 align-items-end">
                    <div class="mr-2">
                        <h3 class="font-weight-bold">{{ $totalCant }}</h3>
                        
                            @if ((Request()->year == 'ally' and Request()->month == 'allm' ) or (empty(Request()->year) and empty(Request()->month)))  
                            
                            @elseif (Request()->year !== 'ally' and Request()->month == 'allm')

                                @if ($percentageTotalCant > 0)
                                    <span class="text-success">
                                        <i class="fas fa-long-arrow-alt-up"></i> 
                                        <span class="pr-2">{{ $percentageTotalCant }}% </span>
                                        <br>
                                        <span class="text--dark-grey" style="font-size:0.8rem;">(comparado con el año anterior)</span>
                                    </span>   
                                @elseif ($percentageTotalCant < 0)
                                    <span class="text-danger">
                                        <i class="fas fa-long-arrow-alt-down"></i> 
                                        <span class="pr-2">{{ $percentageTotalCant }}% </span>
                                        <br>
                                        <span class="text--dark-grey" style="font-size:0.8rem;">(comparado con el año anterior)</span>
                                    </span>  
                                @else
                                    <span>
                                        <span class="pr-2">{{ $percentageTotalCant }}% </span>
                                        <br>
                                        <span class="text--dark-grey" style="font-size:0.8rem;">(comparado con el año anterior)</span>
                                    </span>  
                                @endif
                            @else
                                @if ($percentageTotalCant > 0)
                                    <span class="text-success">
                                        <i class="fas fa-long-arrow-alt-up"></i> 
                                        <span class="pr-2">{{ $percentageTotalCant }}% </span>
                                        <br>
                                        <span class="text--dark-grey" style="font-size:0.8rem;">(comparado con el mes anterior)</span>
                                    </span>   
                                @elseif ($percentageTotalCant < 0)
                                    <span class="text-danger">
                                        <i class="fas fa-long-arrow-alt-down"></i> 
                                        <span class="pr-2">{{ $percentageTotalCant }}% </span>
                                        <br>
                                        <span class="text--dark-grey" style="font-size:0.8rem;">(comparado con el mes anterior)</span>
                                    </span>  
                                @else
                                    <span>
                                        <span class="pr-2">{{ $percentageTotalCant }}% </span>
                                        <br>
                                        <span class="text--dark-grey" style="font-size:0.8rem;">(comparado con el mes anterior)</span>
                                    </span>  
                                @endif
                            @endif

                    </div>
                    <div class="mr-2 mt-3 d-sm-none d-xl-block">
                        <img src="{{ asset('img/bar_chart_1.png') }}" alt="Ilustración de una gráfica">
                    </div>
                </div>
            </div>
        </div>

        <div class="p-lg-4 px-2 py-4 col-sm-4">
            <div class="card p-4">
                <p class="text--dark-grey">Comercios Clientes</p>
                <div class="d-flex justify-content-between mt-3 px-2 align-items-end">
                    <div class="mr-2">
                        <h3 class="font-weight-bold">{{ $merchantsCant }}</h3>
                        
                        @if ((Request()->year == 'ally' and Request()->month == 'allm' ) or (empty(Request()->year) and empty(Request()->month)))  
                            
                        @elseif (Request()->year !== 'ally' and Request()->month == 'allm')

                            @if ($percentageMerchantsCant > 0)
                                <span class="text-success">
                                    <i class="fas fa-long-arrow-alt-up"></i> 
                                    <span class="pr-2">{{ $percentageMerchantsCant }}% </span>
                                    <br>
                                    <span class="text--dark-grey" style="font-size:0.8rem;">(comparado con el año anterior)</span>
                                </span>   
                            @elseif ($percentageMerchantsCant < 0)
                                <span class="text-danger">
                                    <i class="fas fa-long-arrow-alt-down"></i> 
                                    <span class="pr-2">{{ $percentageMerchantsCant }}% </span>
                                    <br>
                                    <span class="text--dark-grey" style="font-size:0.8rem;">(comparado con el año anterior)</span>
                                </span>  
                            @else
                                <span>
                                    <span class="pr-2">{{ $percentageMerchantsCant }}% </span>
                                    <br>
                                    <span class="text--dark-grey" style="font-size:0.8rem;">(comparado con el año anterior)</span>
                                </span>  
                            @endif
                        @else
                            @if ($percentageMerchantsCant > 0)
                                <span class="text-success">
                                    <i class="fas fa-long-arrow-alt-up"></i> 
                                    <span class="pr-2">{{ $percentageMerchantsCant }}% </span>
                                    <br>
                                    <span class="text--dark-grey" style="font-size:0.8rem;">(comparado con el mes anterior)</span>
                                </span>   
                            @elseif ($percentageMerchantsCant < 0)
                                <span class="text-danger">
                                    <i class="fas fa-long-arrow-alt-down"></i> 
                                    <span class="pr-2">{{ $percentageMerchantsCant }}% </span>
                                    <br>
                                    <span class="text--dark-grey" style="font-size:0.8rem;">(comparado con el mes anterior)</span>
                                </span>  
                            @else
                                <span>
                                    <span class="pr-2">{{ $percentageMerchantsCant }}% </span>
                                    <br>
                                    <span class="text--dark-grey" style="font-size:0.8rem;">(comparado con el mes anterior)</span>
                                </span>  
                            @endif
                        @endif
        
                    </div>
                    <div class="mr-2 mt-3 d-sm-none d-xl-block">
                        <img src="{{ asset('img/bar_chart_2.png') }}" alt="Ilustración de una gráfica">
                    </div>
                </div>
            </div>
        </div>

        
        <div class="p-lg-4 px-2 py-4 col-sm-4">
            <div class="card p-4">
                <p class="text--dark-grey">Ganancias Totales</p>
                <div class="d-flex justify-content-between mt-3 px-2 align-items-end">
                        <div class="mr-2">
                            <h3 class="font-weight-bold">{{ presentPrice($earnings) }}</h3>
                            
                            @if ((Request()->year == 'ally' and Request()->month == 'allm' ) or (empty(Request()->year) and empty(Request()->month)))  
                            
                            @elseif (Request()->year !== 'ally' and Request()->month == 'allm')

                                @if ($percentageEarnings > 0)
                                    <span class="text-success">
                                        <i class="fas fa-long-arrow-alt-up"></i> 
                                        <span class="pr-2">{{ $percentageEarnings }}% </span>
                                        <br>
                                        <span class="text--dark-grey" style="font-size:0.8rem;">(comparado con el año anterior)</span>
                                    </span>   
                                @elseif ($percentageEarnings < 0)
                                    <span class="text-danger">
                                        <i class="fas fa-long-arrow-alt-down"></i> 
                                        <span class="pr-2">{{ $percentageEarnings }}% </span>
                                        <br>
                                        <span class="text--dark-grey" style="font-size:0.8rem;">(comparado con el año anterior)</span>
                                    </span>  
                                @else
                                    <span>
                                        <span class="pr-2">{{ $percentageEarnings }}% </span>
                                        <br>
                                        <span class="text--dark-grey" style="font-size:0.8rem;">(comparado con el año anterior)</span>
                                    </span>  
                                @endif
                            @else
                                @if ($percentageEarnings > 0)
                                    <span class="text-success">
                                        <i class="fas fa-long-arrow-alt-up"></i> 
                                        <span class="pr-2">{{ $percentageEarnings }}% </span>
                                        <br>
                                        <span class="text--dark-grey" style="font-size:0.8rem;">(comparado con el mes anterior)</span>
                                    </span>   
                                @elseif ($percentageEarnings < 0)
                                    <span class="text-danger">
                                        <i class="fas fa-long-arrow-alt-down"></i> 
                                        <span class="pr-2">{{ $percentageEarnings }}% </span>
                                        <br>
                                        <span class="text--dark-grey" style="font-size:0.8rem;">(comparado con el mes anterior)</span>
                                    </span>  
                                @else
                                    <span>
                                        <span class="pr-2">{{ $percentageEarnings }}% </span>
                                        <br>
                                        <span class="text--dark-grey" style="font-size:0.8rem;">(comparado con el mes anterior)</span>
                                    </span>  
                                @endif
                            @endif
            

                        </div>
                    <div class="mr-2 mt-3 d-sm-none d-xl-block">
                        <img src="{{ asset('img/bar_chart_3.png') }}" alt="Ilustración de una gráfica">
                    </div>
                </div>
            </div>
        </div>


    </div>

    <div class="row d-flex">
        <div class="p-lg-4 px-2 py-4 col-lg-7">
            <div class="card p-4" >
                <p class="text--dark-grey">Productos más Vendidos</p>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" class="p-3" style="border-top:unset">Código</th>
                                <th scope="col" class="p-3" style="border-top:unset">Producto</th>
                                <th scope="col" class="p-3" style="border-top:unset">Disponibilidad</th>
                                <th scope="col" class="p-3" style="border-top:unset">Cantidad de vendidos</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if (empty($products))
                                <tr>
                                    <td colspan="4" class="text-center pt-4">No hay resultados disponibles</td>
                                </tr>
                            @endif
                            @foreach ($products as $product)
                                <tr>
                                    <td class="p-3">{{ $product['product_id'] }}</td>
                                    <td class="p-3">{{ $product['nombre'] }}</td>
                                    <td class="p-3">
                                        <span class="badge badge-pill badge-success py-2 px-3">Placeholder en stock</span>
                                    </td>
                                    <td class="p-3">{{ $product['cantidad'] }}</td>
                                </tr>    
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="p-lg-4 px-2 py-4 col-lg-5">
            <div class="card p-4">
                <p class="text--dark-grey mb-4">Resumen de los Pedidos</p>
                <div class="d-flex justify-content-between my-3 mx-2 p-1">
                    <div class="d-flex">
                        <span class="circle-order-state terciary"></span>
                        <p class="d-flex align-items-center pl-3 mb-1">Sin procesar</p>
                    </div>
                    <div class="d-flex align-items-center mb-1">
                        <p class="m-0 font-weight-bold">{{ $cantPedidos['sinproc'] }} pedidos</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between my-3 mx-2 p-1">
                    <div class="d-flex">
                        <span class="circle-order-state secondary"></span>
                        <p class="d-flex align-items-center pl-3 mb-1">Procesando</p>
                    </div>
                    <div class="d-flex align-items-center mb-1">
                        <p class="m-0 font-weight-bold">{{ $cantPedidos['proc'] }} pedidos</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between my-3 mx-2 p-1">
                    <div class="d-flex">
                        <span class="circle-order-state primary"></span>
                        <p class="d-flex align-items-center pl-3 mb-1">Listos para retirar</p>
                    </div>
                    <div class="d-flex align-items-center mb-1">
                        <p class="m-0 font-weight-bold">{{ $cantPedidos['retirar'] }} pedidos</p>
                    </div>
                </div>
                <div class="d-flex justify-content-between my-3 mx-2 p-1">
                    <div class="d-flex">
                        <span class="circle-order-state success"></span>
                        <p class="d-flex align-items-center pl-3 mb-1">Retirados</p>
                    </div>
                    <div class="d-flex align-items-center mb-1">
                        <p class="m-0 font-weight-bold">{{ $cantPedidos['retirados'] }} pedidos</p>
                    </div>
                </div>

                <div class="mt-4 ml-3">
                    <a class="btn-link" href="{{ route('order.index') }}">Gestionar Pedidos<i class="fas fa-arrow-right ml-2"></i></a>
                </div>
            </div>
        </div>
    </div>

</div>
    
@endsection

