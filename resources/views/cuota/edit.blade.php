@extends('layouts.plantilla')

@section('seccion')
<form action="{{ route('cuota.update', $cuota) }}" method="POST">
    @csrf
    @method('PUT')
    <fieldset class="border p-4">
        <legend class="w-auto">Editar Cuota</legend>

        <div class="form-group">
            @error('cliente_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="cliente_id">Cliente</label>
            @enderror
            <select class="form-control" name="cliente_id" id="cliente_id">
                <option value="" hidden>Selecciona un cliente</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id }}" {{ old('cliente_id', $cuota->cliente_id) == $cliente->id ? 'selected' : '' }}>{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            @error('remesa_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="remesa_id">Remesa (Opcional)</label>
            @enderror
            <select class="form-control" name="remesa_id" id="remesa_id">
                <option value="">Ninguna</option>
                @foreach($remesas as $remesa)
                    <option value="{{ $remesa->id }}" {{ old('remesa_id', $cuota->remesa_id) == $remesa->id ? 'selected' : '' }}>{{ $remesa->descripcion }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group" id="importe-form"></div>
        
        <div class="form-group" id="emision-form"></div>

        <div class="form-group">
            @error('fecha_pago')
                <div class="alert alert-danger">{{ $message }}</div>
            @else
                <label for="fecha_pago">Fecha Pago</label>
            @enderror
            <input type="date" class="form-control" name="fecha_pago" id="fecha_pago" value="{{ old('fecha_pago', $cuota->fecha_pago ? \Carbon\Carbon::parse($cuota->fecha_pago)->format('Y-m-d') : '') }}">
        </div>

        <div class="form-group" id="notas-form"></div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('cuota.index') }}" class="btn btn-secondary">Cancelar</a>
    </fieldset>
</form>

<script>
    $(document).ready(function() {
        function toggleFields() {
            if ($('#remesa_id').val() == '') {
                $('#importe-form').html(`
                    <div class="form-group">
                        @error('importe')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @else
                            <label for="importe">Importe</label>
                        @enderror
                        <input type="number" step="0.01" class="form-control" name="importe" id="importe" value="{{ old('importe', $cuota->importe) }}">
                    </div>
                `);
                $('#emision-form').html('');
                $('#notas-form').html(`
                    <div class="form-group">
                        @error('notas')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @else
                            <label for="notas">Notas</label>
                        @enderror
                        <input type="text" class="form-control" name="notas" id="notas" value="{{ old('notas', $cuota->notas) }}">
                    </div>
                `);
            } else {
                $('#importe-form').html('');
                $('#emision-form').html(`
                    <div class="form-group">
                        @error('fecha_emision')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @else
                            <label for="fecha_emision">Fecha Emisión</label>
                        @enderror
                        <input type="date" class="form-control" name="fecha_emision" id="fecha_emision" value="{{ old('fecha_emision', $cuota->fecha_emision ? \Carbon\Carbon::parse($cuota->fecha_emision)->format('Y-m-d') : '') }}">
                    </div>
                `);
                $('#notas-form').html('');
            }
        }

        toggleFields();

        $('#remesa_id').change(function() {
            toggleFields();
        });
    });
</script>
@endsection