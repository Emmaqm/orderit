@extends('layouts.app')

@section('title', 'Resumen')


@section('content')


<div class="px-md-4 container-fluid">

    <div class="mt-2 p-1 ml-4 mb-4">
        <h2 class="ml-0 mt-1 mb-2 text--darkest-grey">Resumen</h2>
        <div class="underline m-0 l-1"></div>
    </div>


    <div class="row d-flex justify-content-between p-0">
        <div class="p-lg-4 px-2 py-4 col-12">
            <div class="card p-2 p-sm-4 text-sm-left text-center">
                <p class="text--dark-grey pt-sm-3 pl-sm-3 pl-0 pt-2"><i class="fas fa-user mr-3 fa-lg --link"></i>Datos personales</p>

                <div class="d-flex py-4 px-1 px-md-3 justify-content-center justify-content-sm-start flex-wrap justify-content-center" style="border-radius: 5px;">
                    <div>
                        <span class="avatar-img" style="background-image: url('{{ asset('storage/'. Auth::user()->avatar) }}')"></span>
                    </div>
                    
                    <div class="ml-3 mt-1">
                        <h5 class="m-0 mt-1">{{ $user->nombre . " " . $user->apellido }}</h5>
                        <p class="m-0 text--dark-grey">{{ $user->email }}</p>
                    </div>
  
                </div>
                
                <div class="px-1 px-md-3 py-1 mb-2">
                    <a href="{{ route('user.edit') }}" class="btn bt-primary"><i class="fas fa-edit mr-2"></i>Editar datos</a>
                </div>
            </div>
        </div>

        <div class="p-lg-4 px-2 py-4 col-12">
            <div class="card p-2 p-sm-4 text-sm-left text-center">
                <p class="text--dark-grey pt-sm-3 pl-sm-3 pl-0 pt-2"><i class="fas fa-user-check fa-lg mr-3 --link"></i>Solicitudes de autorización</p>

                <div>
                    @if (empty($users[0]))
                        <div class="d-inline-block alert alert-info mt-2 mb-1" role="alert">
                            No tienes solicitudes de autorización en este momento
                        </div>    
                    @endif
                    @foreach ($users as $user)
                        <div class="d-none d-sm-flex py-4 px-1 px-md-3 justify-content-center justify-content-sm-start" style="border-radius: 5px;">
                            <div>
                                <span class="avatar-img" style="background-image: url('{{ asset('storage/'. Auth::user()->avatar) }}')"></span>
                            </div>
                            
                            <div class="ml-3 mt-1">
                                <h5 class="m-0 mt-1">{{ $user->nombre . " " . $user->apellido }}</h5>
                                <p class="m-0 text--dark-grey">{{ $user->email }}</p>
                            </div>

                            <div class="d-flex align-items-center ml-4">
                                <form action="{{ route('user.autorize', $user->email) }}" method="POST">
                                    @csrf
                                    @method('PATCH')  
                                        
                                    <button class="btn p-0 m-0" type="submit"><i class="fas fa-check-circle fa-2x text-success" style="opacity:0.8;"></i></button>
                                </form>
    
                                <form class="remove-btn" action="{{ route('user.destroy', $user->email) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                
                                    <button class="btn p-0 m-0 ml-2" type="submit"><i class="fas fa-times-circle fa-2x text-danger" style="opacity:0.8;"></i></button>
                                </form>
                            </div>
                        </div>

                        <div class="d-inline-block d-sm-none py-4 px-1 px-md-3" style="border-radius: 5px;">
                            <div>
                                <span class="avatar-img" style="background-image: url('{{ asset('storage/'. Auth::user()->avatar) }}')"></span>
                            </div>
                            
                            <div class="d-flex flex-wrap justify-content-center">
                                <div class="ml-0 mt-1">
                                    <h5 class="m-0 mt-1">{{ $user->nombre . " " . $user->apellido }}</h5>
                                    <p class="m-0 text--dark-grey">{{ $user->email }}</p>
                                </div>
    
                                <div class="d-flex align-items-center ml-3 ml-sm-4 mt-2 mt-sm-0">                                      
                                    <form action="{{ route('user.autorize', $user->email) }}" method="POST">
                                        @csrf
                                        @method('PATCH')  
                                            
                                        <button class="btn p-0 m-0" type="submit"><i class="fas fa-check-circle fa-2x text-success" style="opacity:0.8;"></i></button>
                                    </form>
                
                                    <form class="remove-btn" action="{{ route('user.destroy', $user->email) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    
                                        <button class="btn p-0 m-0 ml-2" type="submit"><i class="fas fa-times-circle fa-2x text-danger" style="opacity:0.8;"></i></button>
                                    </form>
                                </div>
        
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="p-lg-4 px-2 py-4 col-12">
            <div class="card p-2 p-sm-4 text-sm-left text-center">
                <p class="text--dark-grey pt-sm-3 pl-sm-3 pl-0 pt-2"><i class="fas fa-truck-loading fa-lg mr-3 --link"></i>Pedidos en curso</p>

                <div class="d-flex py-4 px-1 px-md-3 justify-content-center justify-content-sm-start flex-wrap justify-content-center" style="border-radius: 5px;">
                    <table>
                        <thead>
                            <tr>
                                <th>Código</th>
                                <th>Fecha</th>
                                <th>Detalles</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td class="text-center" style="vertical-align:middle;"> <a  href="{{ route('order.details', $order->id) }}">Ver detalles</a> </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
                
                <div class="px-1 px-md-3 py-1 mb-2">
                    <a href="{{ route('order.indexM') }}" class="btn bt-primary">Ver todos los pedidos</a>
                </div>

            </div>
        </div>

    </div>

    <style>
        td,th{
            padding: 12px 20px;
            border-bottom: 1px solid #dee2e6;
        }
    
    </style>
</div>

@endsection