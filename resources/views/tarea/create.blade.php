@extends('layouts.plantilla')
@section('seccion')
<form action="{{ route("tarea.store") }}" method="POST" enctype="multipart/form-data" class="container my-4">
    @csrf
    <fieldset class="border p-4">
        <legend class="w-auto"><b>Formulario Creacióm de Tarea</b></legend>

        @if(Auth::user()->rol == 'A')

            <div class="form-group">
                @error('cliente_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @else
                    <label for="cliente_id">Cliente</label>
                @enderror
                <select class="form-control" name="cliente_id" id="cliente_id">
                    <option value="0" hidden>Seleccione un Cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id }}" {{ old('cliente_id') == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                    @endforeach
                </select>
            </div>

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
                    <label for="correo_contacto">Correo del Contacto</label>
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
                @error('operario_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @else
                    <label for="form-control">Operario Asignado</label>
                @enderror
                <select class="form-control" name="operario_id" id="operario_id">
                    <option value="0" hidden>Seleccione un Operario</option>
                    @foreach($operarios as $operario)
                        <option value="{{ $operario->id }}" {{ old('operario_id') == $operario->id ? 'selected' : '' }}>{{ $operario->name }}</option>
                    @endforeach
                </select>
            </div>
        @endif
            
        <div class="form-group">
            @error('fecha_realizacion')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="fecha_realizacion">Fecha de Realización</label>
            @enderror
            <input type="date" class="form-control" name="fecha_realizacion" id="fecha_realizacion" value="{{ old('fecha_realizacion') }}">
        </div>

        <div class="form-group">
            @error('estado')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="estado">Estado de la Tarea</label>
            @enderror
            <div class="form-check">
                <input type="radio" class="form-check-input" name="estado" value="B" {{ old('estado') == 'B' ? 'checked' : '' }}>Esperando a Ser Aprobada
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="estado" value="P" {{ old('estado') == 'P' ? 'checked' : '' }}>Pendiente
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="estado" value="R" {{ old('estado') == 'R' ? 'checked' : '' }}>Realizada
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="estado" value="C" {{ old('estado') == 'C' ? 'checked' : '' }}>Cancelada
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

        <div class="form-group">
            @error('anotaciones_posteriores')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="anotaciones_posteriores">Anotaciones Posteriores a la Tarea</label>
            @enderror
            <textarea class="form-control" name="anotaciones_posteriores" id="anotaciones_posteriores">{{ old('anotaciones_posteriores') }}</textarea>
        </div>

        <div class="form-group">
            @error('fichero')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="fichero">Fichero Resumen de las Tareas Realizadas</label>
            @enderror
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="fichero" id="customFileLang" lang="es" accept=".pdf" value="{{ old('fichero') }}" onchange="document.getElementById('customFileLabel').innerHTML = this.files[0].name">
                <label class="custom-file-label" for="customFileLang" id="customFileLabel" data-browse=".pdf">Seleccionar Archivo</label>
            </div>
        </div>

        <div class="form-group">
            @error('foto')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="foto">Foto de las Tareas Realizadas</label>
            @enderror
            <div class="custom-file">
                <input type="file" class="custom-file-input" name="foto" id="customFileLangFoto" lang="es" accept=".jpg, .jpeg, .png" value="{{ old('foto') }}" onchange="document.getElementById('customFileLabelFoto').innerHTML = this.files[0].name">
                <label class="custom-file-label" for="customFileLangFoto" id="customFileLabelFoto" data-browse=".jpg .jpeg .png">Seleccionar Archivo</label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </fieldset>
</form>
@endsection