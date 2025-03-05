@extends('layouts.plantilla')
@section('seccion')
<table class="table table-bordered">
    <tr>
        <td>
            <a href="{{ route('cliente.edit', ['cliente' => $cliente->id]) }}" class="btn btn-warning w-100">
                Modificar 
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                </svg>    
            </a>
        </td>
        <td>
            <button type="button" class="btn btn-danger w-100" data-toggle="modal" data-target="#confirmDeleteModal-{{ $cliente->id }}">
                Eliminar 
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>    
            </button>
        </td>
    </tr>
    <tr>
        <td>Id Cliente</td>
        <td>{{ $cliente->id }}</td>
    </tr>    
    <tr>
        <td>País</td>
        <td>
            <a href="#" data-toggle="modal" data-target="#detallesPais{{ $cliente->id }}">
                {{ $cliente->pais->nombre }}
            </a>
        </td>
    </tr>
    <tr>
        <td>CIF</td>
        <td>{{ $cliente->cif }}</td>
    </tr>    
    <tr>
        <td>Nombre</td>
        <td>{{ $cliente->nombre }}</td>
    </tr>    
    <tr>
        <td>Teléfono</td>
        <td>{{ $cliente->telefono }}</td>
    </tr>    
    <tr>
        <td>Correo</td>
        <td>{{ $cliente->correo }}</td>
    </tr>    
    <tr>
        <td>Cuenta Corriente</td>
        <td>{{ $cliente->cuenta_corriente }}</td>
    </tr>    
    <tr>
        <td>Moneda</td>
        <td>{{ $cliente->moneda }}</td>
    </tr>    
    <tr>
        <td>Importe Mensual</td>
        <td>{{ $cliente->importe_mensual }}</td>
    </tr>
</table>

<!-- Modal -->
<div class="modal fade" id="confirmDeleteModal-{{ $cliente->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel-{{ $cliente->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel-{{ $cliente->id }}">Confirmar Eliminación</h5>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este cliente?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form action="{{ route('cliente.destroy', ['cliente' => $cliente]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="detallesPais{{ $cliente->id }}" tabindex="-1" aria-labelledby="detallesPaisLabel{{ $cliente->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detallesPaisLabel{{ $cliente->id }}">Información del País</h5>
            </div>
            <div class="modal-body">
                <p><strong>ID | ISO2 | ISO3:</strong> {{ $cliente->pais->id }} | {{ $cliente->pais->iso2 }} | {{ $cliente->pais->iso3 }}</p>
                <p><strong>Nombre:</strong> {{ $cliente->pais->nombre }}</p>
                <p><strong>Continente:</strong> {{ $cliente->pais->continente }}</p>
                <p><strong>Subcontinente:</strong> {{ $cliente->pais->subcontinente }}</p>
                <p><strong>Moneda:</strong> {{ $cliente->pais->nombre_moneda }}</p>
                <p><strong>ISO Moneda:</strong> {{ $cliente->pais->iso_moneda }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>
@endsection