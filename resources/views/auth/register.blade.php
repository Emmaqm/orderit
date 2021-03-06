@extends('layouts.loginlogout')

@section('content')

<div class="container-full">
    <div class="container-left">
        <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card pb-4">
                                <div class="logo-wrapper p-4 text-center">
                                    <a href="{{ url('/home') }}">
                                        <img class="m-3" src="{{ asset('img/logo-whitebg.svg') }}" alt="Logo Orderit">
                                    </a>
                                </div>        
                                <div class="card-body">
                                    <div class="login-title">
                                        <h1 class="text-center">Crear nueva cuenta</h1>
                                    </div>
                                    <p class="welcome-message font-weight-light text-center">Completa los datos para crear una nueva cuenta</p>
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="form-row">
                                            <div class="col">
                                                    <label for="nombre">{{ __('Nombre') }}</label>
                                                    <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}" required autofocus>
                    
                                                        @if ($errors->has('nombre'))
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $errors->first('nombre') }}</strong>
                                                            </span>
                                                        @endif
                                            </div>
                            
                                            <div class="col">
                                                <label for="apellido">{{ __('Apellido') }}</label>
                                                <input id="apellido" type="text" class="form-control{{ $errors->has('apellido') ? ' is-invalid' : '' }}" name="apellido" value="{{ old('apellido') }}" required autofocus>
                    
                                                    @if ($errors->has('apellido'))
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $errors->first('apellido') }}</strong>
                                                        </span>
                                                    @endif
                                            </div>
                                        </div>
                                       
                
                                        <div class="form-group">
                                            <label for="email">{{ __('Correo Electrónico') }}</label>
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                
                                        <div class="form-group">
                                            <label for="telefono">{{ __('Teléfono') }}</label>
                                            <input id="telefono" type="text" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="{{ old('telefono') }}" required>
                
                                                @if ($errors->has('telefono'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('telefono') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                
                                        <div class="form-group">
                                            <label for="password">{{ __('Contraseña') }}</label>
                                            <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                
                                                @if ($errors->has('password'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                                        
                
                                        <div class="form-group">
                                            <label for="password-confirm">{{ __('Repetir Contraseña') }}</label>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        </div>
        
                
                                        <div class="form-group">
                                            <label>Elija una de las opciones</label>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="comercioNuevo" id="es-nuevo-establecimiento-no" value="no" checked>
                                                <label class="form-check-label" for="es-nuevo-establecimiento-no">
                                                  Mi Comercio ya esta registrado.
                                                </label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="comercioNuevo" id="es-nuevo-establecimiento-si" value="si">
                                                <label class="form-check-label" for="es-nuevo-establecimiento-si">
                                                    Deseo registrar mi Comercio.
                                                </label>
                                            </div>                                            
                                        </div>
        


                                        <div class="form-group" id="id-establecimiento">
                                            <label for="id_comercio">{{ __('Código de comercio') }}</label>
                                            <input id="id_comercio" type="text" class="id_comercio form-control{{ $errors->has('id_comercio') ? ' is-invalid' : '' }}" name="id_comercio">
                    
                                                @if ($errors->has('id_comercio'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('id_comercio') }}</strong>
                                                    </span>
                                                @endif
                                        </div>
                
                                        <div class="form-group mb-0 mt-4 pt-2">
                                            <div class=" text-center">
                                                <button type="submit" class="btn bt-primary">
                                                    {{ __('Registrarse') }}
                                                </button>
                                                <a class="btn btn-link has-user" href="{{ route('login') }}">
                                                    {{ __('¿Ya tienes una cuenta?') }}
                                                </a>
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

@section('extra-js')

<script src="{{ asset('js/register.js') }}"></script>
    
@endsection