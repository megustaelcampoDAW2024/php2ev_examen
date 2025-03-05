@extends('layouts.plantilla')

@section('seccion')
<div class="container mt-5">
    <fieldset class="border p-4">
        <legend class="w-auto"><b>Editar Cliente</b></legend>
        <form action="{{ route('cliente.update', $cliente->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                @error('pais_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                @else
                    <label for="pais_id">País</label>
                @enderror
                <select class="form-control" id="pais_id" name="pais_id">
                    @foreach($paises as $pais)
                        <option value="{{ $pais->id }}" {{ old('pais_id', $cliente->pais_id) == $pais->id ? 'selected' : '' }}>{{ $pais->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                @error('cif')
                    <div class="alert alert-danger">{{ $message }}</div>
                @else
                    <label for="cif">CIF</label>
                @enderror
                <input type="text" class="form-control" id="cif" name="cif" value="{{ old('cif', $cliente->cif) }}" required>
            </div>
            <div class="form-group">
                @error('nombre')
                    <div class="alert alert-danger">{{ $message }}</div>
                @else
                    <label for="nombre">Nombre</label>
                @enderror
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{ old('nombre', $cliente->nombre) }}" required>
            </div>
            <div class="form-group">
                @error('telefono')
                    <div class="alert alert-danger">{{ $message }}</div>
                @else
                    <label for="telefono">Teléfono</label>
                @enderror
                <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', $cliente->telefono) }}" required>
            </div>
            <div class="form-group">
                @error('correo')
                    <div class="alert alert-danger">{{ $message }}</div>
                @else
                    <label for="correo">E-Mail</label>
                @enderror
                <input type="email" class="form-control" id="correo" name="correo" value="{{ old('correo', $cliente->correo) }}" required>
            </div>
            <div class="form-group">
                @error('cuenta_corriente')
                    <div class="alert alert-danger">{{ $message }}</div>
                @else
                    <label for="cuenta_corriente">Cuenta Corriente</label>
                @enderror
                <input type="text" class="form-control" id="cuenta_corriente" name="cuenta_corriente" value="{{ old('cuenta_corriente', $cliente->cuenta_corriente) }}" required>
            </div>
            <div class="form-group">
                @error('moneda')
                    <div class="alert alert-danger">{{ $message }}</div>
                @else
                    <label for="moneda">Moneda</label>
                @enderror
                <select class="form-control" id="moneda" name="moneda">
                    <option value="0" hidden>Seleccione una moneda</option>
                    @foreach($paises as $pais)
                        @if (isset($pais->iso_moneda))
                        <option value="{{ $pais->iso_moneda }}" {{ old('moneda', $cliente->moneda) == $pais->iso_moneda ? 'selected' : '' }}>{{ $pais->nombre_moneda }}</option>
                        @endif
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                @error('importe_mensual')
                    <div class="alert alert-danger">{{ $message }}</div>
                @else
                    <label for="importe_mensual">Importe Mensual</label>
                @enderror
                <input type="number" step="0.01" class="form-control" id="importe_mensual" name="importe_mensual" value="{{ old('importe_mensual', $cliente->importe_mensual) }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
        </form>
    </fieldset>
</div>
@endsection