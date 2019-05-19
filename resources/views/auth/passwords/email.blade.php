@extends('layouts.loginlogout')

@section('content')

<div class="container-full">
    <div class="container-left"></div>
    <div class="container-right">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">  
        
                        <div class="card-body">
                                <div class="login-title">
                                        <h1 class="text-center">OrderIt</h1>
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
                                        <button type="submit" class="btn btn-primary">
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
</div>

@endsection
