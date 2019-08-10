@extends('layouts.loginlogout')

@section('content')

<div class="container-full">
    <div class="container-left">

    </div>

    <div class="container-right">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="login-title">
                                <h1 class="text-center">Iniciar Sesión</h1>
                            </div>
                            <p class="welcome-message font-weight-light text-center">Ingresa con tus datos para continuar</p>
                            <form method="POST" action="{{ route('login') }}">
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
                                    <div class="text-center">
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
</div>
@endsection
