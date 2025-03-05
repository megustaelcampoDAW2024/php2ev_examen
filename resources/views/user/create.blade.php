@extends('layouts.plantilla')
@section('seccion')
<form action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data" class="container my-4">
    @csrf
    <fieldset class="border p-4">
        <legend class="w-auto"><b>Formulario Creación de Usuario</b></legend>

        <div class="form-group">
            @error('cif')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="cif">CIF</label>
            @enderror
            <input type="text" class="form-control" name="cif" id="cif" value="{{ old('cif') }}">
        </div>

        <div class="form-group">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="name">Nombre</label>
            @enderror
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
        </div>

        <div class="form-group">
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="email">E-Mail</label>
            @enderror
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            @error('telefono')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="telefono">Teléfono</label>
            @enderror
            <input type="text" class="form-control" name="telefono" id="telefono" value="{{ old('telefono') }}">
        </div>

        <div class="form-group">
            @error('direccion')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="direccion">Dirección</label>
            @enderror
            <input type="text" class="form-control" name="direccion" id="direccion" value="{{ old('direccion') }}">
        </div>

        <div class="form-group">
            @error('rol')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="rol">Rol</label>
            @enderror
            <select class="form-control" name="rol" id="rol">
                <option value="0" hidden>Seleccione un Rol</option>
                <option value="A" {{ old('rol') == 'A' ? 'selected' : '' }}>Administrador</option>
                <option value="O" {{ old('rol') == 'O' ? 'selected' : '' }}>Operario</option>
            </select>
        </div>

        <div class="form-group">
            @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="password">Contraseña</label>
            @enderror
            <input type="password" class="form-control" name="password" id="password">
        </div>

        <div class="form-group">
            @error('password_confirmation')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="password_confirmation">Confirmar Contraseña</label>
            @enderror
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary">Crear Usuario</button>
    </fieldset>
</form>
@endsection