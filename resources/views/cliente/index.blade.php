@extends('layouts.plantilla')
@section('seccion')
<table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>País</th>
            <th>CIF</th>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>E-Mail</th>
            <th>Cuenta Corriente</th>
            <th>Moneda</th>
            <th>Importe Mensual</th>
            <th>Cuotas</th>
            <th class="text-center">Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($clientes as $cliente)
            <tr>
                <td>{{ $cliente->id }}</td>
                <td>
                    <a href="#" data-toggle="modal" data-target="#detallesPais{{ $cliente['id'] }}">
                        {{ $cliente->pais->nombre }}
                    </a>
                </td>
                <td>{{ $cliente->cif }}</td>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->telefono }}</td>
                <td>{{ $cliente->correo }}</td>
                <td>{{ $cliente->cuenta_corriente }}</td>
                <td>{{ $cliente->moneda }}</td>
                <td>{{ $cliente->importe_mensual }}</td>
                <td>
                    <table>
                        <thead>
                            <tr>
                                <th>Emision</th>
                                <th>Importe</th>
                                <th>Pagado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cliente->cuotas as $cuota)
                                <tr>
                                    <td>{{ $cuota->fecha_emision }}</td>
                                    <td>{{ $cuota->importe }}</td>
                                    <td>{{ $cuota->fecha_pago }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
                <td class="d-flex justify-content-around">
                    <a href="{{ route("cliente.show", $cliente->id) }}" class="btn btn-outline-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM8 3.5a4.5 4.5 0 1 1 0 9 4.5 4.5 0 0 1 0-9z"/>
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5z"/>
                        </svg>
                    </a>
                    <a href="{{ route("cliente.edit", ['cliente' => $cliente]) }}" class="btn btn-outline-warning">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                        </svg>
                    </a>
                    <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#confirmDeleteModal{{ $cliente['id'] }}"> 
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                        </svg>
                    </a>
                </td>
            </tr>
        @endforeach
        <tr>
            <td colspan="12">
                <a href="{{ route("cliente.create") }}" class="btn btn-success w-100">
                    Añadir Cliente &nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                    </svg>
                </a>
            </td>
        </tr>
    </tbody>
</table>
<div class="d-flex justify-content-center">
    {{ $clientes->links('pagination::bootstrap-4') }}
</div>

<!-- Modal -->
@foreach ($clientes as $cliente)
<div class="modal fade" id="confirmDeleteModal{{ $cliente['id'] }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel{{ $cliente['id'] }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel{{ $cliente['id'] }}">Confirmar Eliminación</h5>
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

<div class="modal fade" id="detallesPais{{ $cliente['id'] }}" tabindex="-1" aria-labelledby="detallesPaisLabel{{ $cliente['id'] }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detallesPaisLabel{{ $cliente['id'] }}">Información del País</h5>
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
@endforeach
@endsection