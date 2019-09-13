@extends('layouts.establishment-info')

@section('title', 'Registro del Establecimiento')

@section('content')

<div class="card p-4 col-12 col-md-8 mx-auto">
    <form method="POST" action="{{ route('establishment.store') }}" class="p-2">
        @csrf
       
        <div class="mb-4 mt-2 p-1 ml-2">
            <h2 class="ml-0 mt-1 mb-2 text--darkest-grey">Datos del Establecimiento</h2>
            <div class="underline m-0 l-1"></div>
        </div>
    
        <div class="alert alert-primary" role="alert">
            <i class="fas fa-info-circle mr-1"></i> Para que <strong>Orderit</strong> pueda validar su Establecimiento y activar su cuenta complete los siguientes datos.
            <hr style="border-top-color:#9dbada" class="my-2">
            <p class="mb-0">Se enviará via <strong>Correo Electrónico</strong> la confirmación de activación.</p>
        </div>


        <div class="form-group">
            <label for="nombre">{{ __('Nombre del Establecimiento') }}</label>
            <input id="nombre" type="text" class="form-control{{ $errors->has('nombre') ? ' is-invalid' : '' }}" name="nombre" value="{{ old('nombre') }}"  required>
    
                @if ($errors->has('nombre'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('nombre') }}</strong>
                    </span>
                @endif
        </div>
    
        <div class="form-group">
            <label for="direccion">{{ __('Dirección') }}</label>
            <input id="direccion" type="text" class="form-control{{ $errors->has('direccion') ? ' is-invalid' : '' }}" name="direccion" value="{{ old('direccion') }}" required>
    
                @if ($errors->has('direccion'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('direccion') }}</strong>
                    </span>
                @endif

                <div class="alert alert-info" role="alert">
                    <i class="fas fa-map-marker-alt mr-1"></i> Una vez activada la cuenta podrá añadir multiples direcciones.    
                </div>
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
    
    
        <div class="form-group mb-0 mt-4 pt-2">
            <div>
                <button type="submit" class="btn bt-primary">
                    {{ __('Enviar datos') }}
                </button>
            </div>
        </div>
    </form>
</div>

@endsection