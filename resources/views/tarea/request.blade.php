@extends('layouts.plantilla')
@section('seccion')
<form action="{{ route("tarea.storeRequest") }}" method="POST" enctype="multipart/form-data" class="container my-4">
    @csrf

    <fieldset class="border p-4 mb-5 bg-light">
        <legend class="w-auto"><b>Identifícate</b></legend>
        
        <div class="form-group">
            @error('cif')
            <div class="alert alert-danger">{{ $message }}</div>
            @else
            <label for="cif">CIF / NIF / DNI</label>
            @enderror
            <input type="cif" class="form-control" name="cif" id="cif" value="{{ old('cif') }}">
        </div>
        
        <div class="form-group">
            @error('telefono')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="telefono">Teléfono</label>
            @enderror
            <input type="telefono" class="form-control" name="telefono" id="telefono" value="{{ old('telefono') }}">
        </div>

        <div class="form-group">
            <select class="form-control" name="cliente_id" id="cliente_id" hidden>
                <option value=""></option>
            </select>
        </div>

    </fieldset>

    <fieldset class="border p-4 bg-light">
        <legend class="w-auto"><b>Formulario Registrar Incidencias</b></legend>

        <div class="form-group">
            @error('nombre_contacto')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="nombre_contacto">Nombre del Contacto</label>
            @enderror
            <input type="text" class="form-control" name="nombre_contacto" id="nombre_contacto" value="{{ old('nombre_contacto') }}">
        </div>

        <div class="form-group">
            @error('apellido_contacto')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="apellido_contacto">Apellido del Contacto</label>
            @enderror
            <input type="text" class="form-control" name="apellido_contacto" id="apellido_contacto" value="{{ old('apellido_contacto') }}">
        </div>

        <div class="form-group">
            @error('correo_contacto')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="correo_contacto">E-Mail del Contacto</label>
            @enderror
            <input type="email" class="form-control" name="correo_contacto" id="correo_contacto" value="{{ old('correo_contacto') }}">
        </div>

        <div class="form-group">
            @error('telefono_contacto')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="telefono_contacto">Teléfono del Contacto</label>
            @enderror
            <input type="text" class="form-control" name="telefono_contacto" id="telefono_contacto" value="{{ old('telefono_contacto') }}">
        </div>

        <div class="form-group">
            @error('descripcion')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="descripcion">Descripción de la Tarea</label>
            @enderror
            <textarea class="form-control" name="descripcion">{{ old('descripcion') }}</textarea>
        </div>

        <div class="form-group">
            @error('direccion')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="direccion">Dirección</label>
            @enderror
            <input type="text" class="form-control" name="direccion" value="{{ old('direccion') }}">
        </div>

        <div class="form-group">
            @error('poblacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="poblacion">Población</label>
            @enderror
            <input type="text" class="form-control" name="poblacion" value="{{ old('poblacion') }}">
        </div>

        <div class="form-group">
            @error('cod_postal')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="cod_postal">Código Postal</label>
            @enderror
            <input type="text" class="form-control" name="cod_postal" value="{{ old('cod_postal') }}">
        </div>

        <div class="form-group">
            @error('provincia_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="provincia_id">Provincia</label>
            @enderror
            <select class="form-control" name="provincia_id" id="provincia_id">
                <option value="0" hidden>Seleccione una Provincia</option>
                @foreach($provincias as $provincia)
                    <option value="{{ $provincia->id }}" {{ old('provincia_id') == $provincia->id ? 'selected' : '' }}>{{ $provincia->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <select class="form-control" name="operario_id" id="operario_id" hidden>
                <option value=""></option> {{-- El operario se inserta null, lo elegirá un administrador más adelante --}}
            </select>
        </div>

        <div class="form-group">
            <div class="form-check">
                <input type="radio" class="form-check-input" name="estado" value="B" hidden>
            </div>
        </div>

        <div class="form-group">
            @error('anotaciones_anteriores')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="anotaciones_anteriores">Anotaciones Anteriores a la Tarea</label>
            @enderror
            <textarea class="form-control" name="anotaciones_anteriores" id="anotaciones_anteriores">{{ old('anotaciones_anteriores') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Enviar</button>
    </fieldset>
</form>
@endsection