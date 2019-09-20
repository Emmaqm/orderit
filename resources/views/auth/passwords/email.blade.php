@extends('layouts.loginlogout')

@section('content')

<div class="container-full">
    <div class="container-left">
            <div class="container" style="padding: 0 3rem 0 3rem">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card" style="min-height: 100vh;">  
                                <div class="logo-wrapper p-4 text-center">
                                    <a href="{{ url('/home') }}">
                                        <img class="m-3" src="{{ asset('img/logo-whitebg.svg') }}" alt="Logo Orderit">
                                    </a>
                                </div>      
                                <div class="card-body">
                                        <div class="login-title">
                                                <h1 class="text-center">Recuperar Contraseña</h1>
                                            </div>
                                            <p class="welcome-message font-weight-light text-center">Para poder restablecer su contraseña ingrese su Correo Electrónico.<br> Recibirá un correo con un enlace al cual deberá acceder para establecer una nueva contraseña.</p>
                                    @if (session('status'))
                                        <div class="alert alert-success" role="alert">
                                            {{ session('status') }}
                                        </div>
                                    @endif
                
                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf
                
                                        <div class="form-group row">   
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                
                                        <div class="form-group mb-0">
                                            <div class="text-center">
                                                <button type="submit" class="btn bt-primary">
                                                    {{ __('Enviar Enlace ') }}
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    </div>
    <div class="container-right p-0">
       
    </div>
</div>

@endsection
