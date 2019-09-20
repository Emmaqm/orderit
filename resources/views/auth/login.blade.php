@extends('layouts.loginlogout')

@section('content')

<div class="container-full">

    <div class="container-left">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card pt-3r">
                            <div class="logo-wrapper position-absolute w-100 pt-4 pb-0 text-center mb-4 mb-md-0" style="top:0">
                                <a href="{{ url('/home') }}">
                                    <img class="m-3" src="{{ asset('img/logo-whitebg.svg') }}" alt="Logo Orderit">
                                </a>
                            </div>  
                            <div class="card-body mt-4 pt-4 pt-md-0 mt-md-auto">
                                <div class="login-title">
                                    <h1 class="text-center">Iniciar Sesión</h1>
                                </div>
                                <p class="welcome-message font-weight-light text-center">Ingresa con tus datos para continuar</p>
                                <form method="POST" action="{{ route('login') }}" class="form-login">
                                    @csrf
            
                                    <div class="form-group">
                                        <label for="email">{{ __('Correo Electrónico') }}</label>
                                        <input id="email" type="email" placeholder="example@example.com" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
            
                                            @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                    </div>
            
                                    <div class="form-group">
                                        <label for="password">{{ __('Contraseña') }}</label>
                                        <input id="password" type="password" placeholder="Contraseña..." class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            
                                            @if ($errors->has('password'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                    </div>
            
                                    <div class="form-group">
                                        <div class="col-md-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            
                                                <label class="form-check-label" for="remember">
                                                    {{ __('Recordarme') }}
                                                </label>
                                            </div>
                                        </div>
                                    </div>
            
                                    <div class="form-group mb-0">
                                        <div class="text-center mt-4">
                                            <button type="submit" class="btn bt-primary">
                                                {{ __('Ingresar') }}
                                            </button>
                                            @if (Route::has('password.request'))
                                            <a class="btn btn-link forgot-pass" href="{{ route('password.request') }}">
                                                {{ __('Recuperar contraseña') }}
                                            </a>
                                            @endif    
    
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    <div class="container-right d-flex align-items-center justify-content-center">


        <div class="text-center mb-4 p-4 z-index-1 mt-4 mt-sm-0 ">

            <div class="p-0">
                <h1 class="--text-white mb-4">¿No tienes una Cuenta?</h1>

                <p class="--text-white m-0">Para crear una nueva cuenta presiona en el botón correspondiente.</p>
                <p class="mt-2 --text-white">Recuerda que las cuentas deben ser validadas por el encargado o dueño del establecimiento.</p>
            </div>

            <div class="p-4 mb-2 --text-white">
                <a href="/register" class="btn bt-secondary-white bt-signup">Registro para Comercios</a>
            </div>

            <div class="--text-white">
                <a href="/register-supplier" class="btn bt-secondary-white bt-signup">Registro para Proveedores</a>
            </div>

            
        </div>
        <div class="bg-skew"></div>
    </div>

    
</div>
@endsection
