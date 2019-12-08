@extends('layouts.app')

@section('title', 'Datos personales')


@section('content')
    
<div class="card p-sm-4 p-2 col-xl-10 col-lg-10 col-md-10 col-sm-10 col-12">
    <form method="POST" action="{{ route('user.update') }}" class="p-2">
        @method('patch')
        @csrf


        <div class="mb-4 mt-2 p-1 ml-2 m-4 pb-3">
            <h2 class="ml-0 mt-1 mb-2 text--darkest-grey">Datos personales</h2>
            <div class="underline m-0 l-1"></div>
        </div>



        <div class="col-xl-7 col-lg-10 col-md-12 col-sm-12 col-12">
             @if (session()->has('success_message'))
                <div class="alert alert-success m-2" role="alert">
                    {{ session()->get('success_message')}}
                </div>
            @endif

            <div class="form-row my-4 mx-2">


                <div class="col p-0 pr-2">
                        <label for="nombre">{{ __('Nombre') }}</label>
                        <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre', $user->nombre) }}" autofocus>
    
                            @if ($errors->has('nombre'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('nombre') }}</strong>
                                </span>
                            @endif
                </div>
    
                <div class="col">
                    <label for="apellido">{{ __('Apellido') }}</label>
                    <input id="apellido" type="text" class="form-control{{ $errors->has('apellido') ? ' is-invalid' : '' }}" name="apellido" value="{{ old('apellido', $user->apellido) }}" autofocus>
    
                        @if ($errors->has('apellido'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('apellido') }}</strong>
                            </span>
                        @endif
                </div>
            </div>
           
    
            <div class="form-group my-4 mx-2">
                <label for="email">{{ __('Correo Electrónico') }}</label>
                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email', $user->email) }}">
    
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
            </div>
    
            <div class="form-group my-4 mx-2">
                <label for="telefono">{{ __('Teléfono') }}</label>
                <input id="telefono" type="text" class="form-control{{ $errors->has('telefono') ? ' is-invalid' : '' }}" name="telefono" value="{{ old('telefono', $user->telefono) }}" >
    
                    @if ($errors->has('telefono'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('telefono') }}</strong>
                        </span>
                    @endif
            </div>
    
            <div class="form-group my-4 mx-2">
                <label for="password">{{ __('Contraseña') }}</label>
                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" >
    
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif

                <p class="alert alert-info"><i class="fas fa-info-circle mr-2"></i> Dejar el campo de contraseña en blanco para mantener la actual.</p>
            </div>

            <div class="form-group my-4 mx-2">
                <label for="password-confirm">{{ __('Repetir Contraseña') }}</label>
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
            </div>


            <div class="form-group mb-0 mt-4 pt-2 my-4 mx-2">
                <div>
                    <button type="submit" class="btn bt-primary">
                        {{ __('Actualizar datos') }}
                    </button>
                </div>
            </div>
        </div>
        
    </form>
</div>


@endsection