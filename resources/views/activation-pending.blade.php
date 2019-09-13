@extends('layouts.empty')

@section('title', 'Cuenta pendiente de activación')

@section('content')



@if (session()->has('message'))

    <div class="card p-4 col-lg-8 mx-auto">
        <div class="mb-4 mt-2 p-1 ml-2">
            <h2 class="ml-0 mt-1 mb-2 text--darkest-grey">Cuenta Pendiente de Activación</h2>
            <div class="underline m-0 l-1"></div>
        </div>


        <div class="alert alert-success" role="alert">
            ¡Los datos del Establecimiento <strong>{{ session()->get('message')}}</strong> han sido guardados correctamente!
        </div>

        <div class="ml-1 mt-2">
            <p class="font-weight-bold">Luego de validada la información recibirá en su correo electrónico la confirmación de activación de la cuenta.</p>
        </div>


        <a class="ml-1 mt-4 btn-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
            <i class="fas fa-arrow-left mr-2"></i><span>Volver al Inicio de Sesión</span>
        </a>
    </div>

@elseif (session()->has('MessageNeedActivation'))


<div class="card p-4 col-lg-8 mx-auto">
    <div class="mb-4 mt-2 p-1 ml-2">
        <h2 class="ml-0 mt-1 mb-2 text--darkest-grey">Cuenta Pendiente de Activación</h2>
        <div class="underline m-0 l-1"></div>
    </div>


    <div class="alert alert-success" role="alert">
        Su cuenta ha sido registrada correctamente.
    </div>

    <div class="ml-1 mt-2">
        <p class="font-weight-bold">Luego de validada la información recibirá en su correo electrónico la confirmación de activación de la cuenta.</p>
    </div>


    <a class="ml-1 mt-4 btn-link" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
        <i class="fas fa-arrow-left mr-2"></i><span>Volver al Inicio de Sesión</span>
    </a>
</div>


@else


    <div class="card p-4 col-lg-6 mx-auto">

        <div class="alert alert-danger" role="alert">
            Notificación Expirada
        </div>


        <a class="ml-1 mt-4 btn-link" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
            <i class="fas fa-arrow-left mr-2"></i><span>Volver al Inicio de Sesión</span>
        </a>
    </div>
    

@endif

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

@endsection