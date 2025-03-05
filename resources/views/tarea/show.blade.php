@extends('layouts.plantilla')
@section('seccion')
<table class="table table-bordered">
    <tr>
        <td @if(Auth::user()->rol == 'O') colspan="2" @endif>
            @if(Auth::user()->rol == 'A')
            <a href="{{ route('tarea.edit', ['tarea' => $tarea]) }}" class="btn btn-warning w-100">
                Modificar 
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                </svg>    
            </a>
            @elseif(Auth::user()->rol == 'O')
            <a href="{{ route('tarea.complete', ['tarea' => $tarea]) }}" class="btn btn-success w-100">
                Completar 
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clipboard-check" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                    <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1z"/>
                    <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0z"/>
                </svg>
            </a>
            @endif
        </td>
        @if(Auth::user()->rol == 'A')
        <td>
            <button type="button" class="btn btn-danger w-100" data-toggle="modal" data-target="#confirmDeleteModal-{{ $tarea->id }}">
                Eliminar 
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                </svg>    
            </button>
        </td>
        @endif
    </tr>
    <tr>
        <td>Id tarea</td>
        <td>{{ $tarea->id }}</td>
    </tr>    
    <tr>
        <td>Cliente</td>
        <td>
            @if (Auth::user()->rol == 'A')
                @if ($tarea->cliente->deleted_at)
                    <a href="#" class="text-danger" data-toggle="modal" data-target="#detallesCliente{{ $tarea->cliente->id }}">
                        {{ $tarea->cliente->nombre }}
                    </a>
                @else
                    <a href="#" data-toggle="modal" data-target="#detallesCliente{{ $tarea->cliente->id }}">
                        {{ $tarea->cliente->nombre }}
                    </a>
                @endif
            @else
                {{ $tarea->cliente->nombre }}
            @endif
        </td>
    </tr>
    <tr>
        <td>Operario</td>
        <td>
            @if($tarea->operario_id && $tarea->operario)
                @if ($tarea->operario->deleted_at)
                    <a href="#" class="text-danger" data-toggle="modal" data-target="#detallesOperario{{ $tarea->operario->id }}">
                        {{ $tarea->operario->name }}
                    </a>
                @else
                    <a href="#" data-toggle="modal" data-target="#detallesOperario{{ $tarea->operario->id }}">
                        {{ $tarea->operario->name }}
                    </a>
                @endif
            @else
                <span class="badge bg-secondary text-white w-25" style="padding: 13px 0px">Operario por Asignar</span>
            @endif
        </td>
    </tr>
    <tr>
        <td>Nombre de Contacto</td>
        <td>{{ $tarea->nombre_contacto }}</td>
    </tr>    
    <tr>
        <td>Apellidos de Contacto</td>
        <td>{{ $tarea->apellido_contacto }}</td>
    </tr>    
    <tr>
        <td>Teléfono de Contacto</td>
        <td>{{ $tarea->telefono_contacto }}</td>
    </tr>    
    <tr>
        <td>Email de Contacto</td>
        <td>{{ $tarea->correo_contacto }}</td>
    </tr>    
    <tr>
        <td>Descripción</td>
        <td>{{ $tarea->descripcion }}</td>
    </tr>    
    <tr>
        <td>Dirección</td>
        <td>{{ $tarea->direccion }}</td>
    </tr>    
    <tr>
        <td>Población</td>
        <td>{{ $tarea->poblacion }}</td>
    </tr>    
    <tr>
        <td>Código Postal</td>
        <td>{{ $tarea->cod_postal }}</td>
    </tr>    
    <tr>
        <td>Provincia</td>
        <td>
            @if($tarea->provincia_id)
            {{ $tarea->provincia->nombre }}
            @endif
        </td>
    </tr>    
    <tr>
        <td>Fecha Creación</td>
        <td>{{ $tarea->created_at }}</td>
    </tr>    
    <tr>
        <td>Estado</td>
        <td>
            @if ($tarea->estado == 'B')
            <span class="badge bg-secondary text-white w-25" style="padding: 13px 0px">Por Aprobar</span>
            @elseif ($tarea->estado == 'P')
            <span class="badge bg-primary text-white w-25" style="padding: 13px 0px">Pendiente</span>
            @elseif ($tarea->estado == 'R')
            <span class="badge bg-success text-white w-25" style="padding: 13px 0px">Realizada</span>
            @elseif ($tarea->estado == 'C')
            <span class="badge bg-danger text-white w-25" style="padding: 13px 0px">Cancelada</span>
            @endif
        </td>
    </tr>    
    <tr>
        <td>Fecha Realización</td>
        @if ($tarea['fecha_realizacion'])
            <td>{{ \Carbon\Carbon::parse($tarea->fecha_realizacion)->format('d-m-Y') }}</td>
        @endif
    </tr>    
    <tr>
        <td>Anotaciones Anteriores</td>
        <td>{{ $tarea->anotaciones_anteriores }}</td>
    </tr>    
    <tr>
        <td>Anotaciones Posteriores</td>
        <td>{{ $tarea->anotaciones_posteriores }}</td>
    </tr>    
    <tr>
        <td>Fichero Resumen</td>
        <td>
            @if($tarea->fichero)
                <a href="{{ asset('storage/' . $tarea->fichero) }}" target="_blank" class="btn btn-info">CONSULTAR</a>
                <a href="{{ asset('storage/' . $tarea->fichero) }}" download class="btn btn-success">DESCARGAR</a><br><br>
                <embed src="{{ asset('storage/' . $tarea->fichero) }}" width="440px" height="600px">
            @endif
        </td>
    </tr>
    <tr>
        <td>Foto</td>
        <td>
            @if($tarea->foto)
                <a href="{{ asset('storage/' . $tarea->foto) }}" target="_blank" class="btn btn-info">CONSULTAR</a>
                <a href="{{ asset('storage/' . $tarea->foto) }}" download class="btn btn-success">DESCARGAR</a><br><br>
                <img src="{{ asset('storage/' . $tarea->foto) }}" alt="Foto" width="400px">
            @endif
        </td>
    </tr>
</table>

<!-- Modal -->
<div class="modal fade" id="confirmDeleteModal-{{ $tarea->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel-{{ $tarea->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel-{{ $tarea->id }}">Confirmar Eliminación</h5>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar esta tarea?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <form action="{{ route('tarea.destroy', ['tarea' => $tarea]) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detallesCliente{{ $tarea->cliente->id }}" tabindex="-1" aria-labelledby="detallesClienteLabel{{ $tarea->cliente->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detallesClienteLabel{{ $tarea->cliente->id }}">Información del Cliente</h5>
            </div>
            <div class="modal-body">
                <p><strong>ID: </strong>{{$tarea->cliente->id}}</p>
                <p><strong>Nombre: </strong>{{$tarea->cliente->nombre}}</p>
                <p><strong>CIF: </strong>{{$tarea->cliente->cif}}</p>
                <p><strong>Teléfono: </strong>{{$tarea->cliente->telefono}}</p>
                <p><strong>Correo: </strong>{{$tarea->cliente->correo}}</p>
                <p><strong>Cuenta Corriente: </strong>{{$tarea->cliente->cuenta_corriente}}</p>
                <p><strong>Moneda: </strong>{{$tarea->cliente->moneda}}</p>
                <p><strong>Importe Mensual: </strong>{{$tarea->cliente->importe_mensual}}</p>
                <p><strong>País: </strong>{{$tarea->cliente->pais->nombre}}</p>
                @if ($tarea->cliente->deleted_at)
                    <p class="text-danger"><strong>Estado: </strong>Eliminado</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>

@if($tarea->operario_id && $tarea->operario)
    <div class="modal fade" id="detallesOperario{{ $tarea->operario->id }}" tabindex="-1" aria-labelledby="detallesOperarioLabel{{ $tarea->operario->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detallesOperarioLabel{{ $tarea->operario->id }}">Información del Operario Encargado</h5>
                </div>
                <div class="modal-body">
                    <p><strong>ID: </strong>{{$tarea->operario->id}}</p>
                    <p><strong>Nombre: </strong>{{$tarea->operario->name}}</p>
                    <p><strong>Email: </strong>{{$tarea->operario->email}}</p>
                    <p><strong>Teléfono: </strong>{{$tarea->operario->telefono}}</p>
                    <p><strong>Dirección: </strong>{{$tarea->operario->direccion}}</p>
                    @if ($tarea->operario->deleted_at)
                        <p class="text-danger"><strong>Estado: </strong>Eliminado</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection