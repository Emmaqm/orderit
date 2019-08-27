@extends('layouts.loginlogout')

@section('content')

<div class="container-full">
    <div class="container-left">
            <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-body">
                                    <div class="login-title">
                                            <h1 class="text-center">Establecer Nueva Contraseña</h1>
                                    </div>
                                    <p class="welcome-message font-weight-light text-center">Complete los campos para establecer una nueva contraseña.</p>
                                    <form method="POST" action="{{ route('password.update') }}">
                                        @csrf
                
                                        <input type="hidden" name="token" value="{{ $token }}">
                
                                        <div class="form-group">
                                            <label for="email">{{ __('Correo Electrónico') }}</label>
                                            <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
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
                                            <label for="password-confirm">{{ __('Repetir contraseña') }}</label>
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                        </div>
                
                                        <div class="form-group mb-0">
                                            <div class="text-center">
                                                <button type="submit" class="btn bt-primary">
                                                    {{ __('Restablecer contraseña') }}
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
    <div class="container-right">
          
    </div>
</div>


@endsection
