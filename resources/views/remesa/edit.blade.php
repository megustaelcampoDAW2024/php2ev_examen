@extends('layouts.plantilla')

@section('seccion')
<form action="{{ route('remesa.update', $remesa) }}" method="POST">
    @csrf
    @method('PUT')
    <fieldset class="border p-4">
        <legend class="w-auto">Editar Remesa</legend>

        @error('unique_remesa')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        
        <div class="form-group">
            @error('importe')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="mes">Mes</label>
            @enderror
            <select class="form-control" name="mes" id="mes" required>
                @php
                    $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                @endphp
                @for ($i = 1; $i <= 12; $i++)
                    <option value="{{ $i }}" {{ old('mes', $remesa->mes, date('m')) == $i ? 'selected' : '' }}>
                        {{ $meses[$i - 1] }}
                    </option>
                @endfor
            </select>
        </div>
        <div class="form-group">
            @error('importe')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="ano">Año</label>
            @enderror
            <input type="number" class="form-control" name="ano" id="ano" value="{{ old('ano', $remesa->ano) }}" required>
        </div>
        <div class="form-group">
            @error('importe')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="descripcion">Descripción (Opcional)</label>
            @enderror
            <input type="text" class="form-control" name="descripcion" id="descripcion" value="{{ old('descripcion', $remesa->descripcion) }}">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Remesa</button>
        <button type="submit" name="editar_y_enviar" class="btn btn-success">Actualizar y Enviar Cuotas</button>
        <a href="{{ route('cuota.index') }}" class="btn btn-secondary">Cancelar</a>
    </fieldset>
</form>
@endsection