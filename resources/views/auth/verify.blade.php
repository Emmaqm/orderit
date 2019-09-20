@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="logo-wrapper p-4 text-center">
                <a href="{{ url('/home') }}">
                    <img class="m-3" src="{{ asset('img/logo-whitebg.svg') }}" alt="Logo Orderit">
                </a>
            </div>      
            <div class="card mt-3r">
                <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Se ha enviado el enlace a su casilla de correo.') }}
                        </div>
                    @endif

                    {{ __('Antes de continuar, por favor revise si ha llegado el enlace a su casilla.') }}
                    {{ __('Si no ha recibido ningún correo') }}, <a href="{{ route('verification.resend') }}">{{ __('presione aquí para enviarlo nuevamente.') }}</a>.
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection
