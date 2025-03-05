@extends('layouts.plantilla')
@section('seccion')
<table class="table table-bordered">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>CIF</th>
            <th>Nombre</th>
            <th>E-Mail</th>
            <th>Teléfono</th>
            <th>Dirección</th>
            <th>Rol</th>
            <th>Fecha de Creación</th>
            @if (Auth::user()->rol == 'A')
            <th colspan="2" class="text-center">Opciones</th>
            @elseif (Auth::user()->rol == 'O')
            <th class="text-center">Modificar mis Datos</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->cif }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->telefono }}</td>
                <td>{{ $user->direccion }}</td>
                <td>
                    @if ($user->rol == 'A')
                        <span class="badge bg-success text-white w-100" style="padding: 13px 0px">Administrador</span>
                    @elseif ($user->rol == 'O')
                        <span class="badge bg-info text-white w-100" style="padding: 13px 0px">Operario</span>
                    @endif
                </td>
                <td>
                    @if ($user->created_at)
                        {{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}
                    @endif
                </td>
                <td class="d-flex justify-content-around">
                    <a href="{{ route('user.edit', $user->id) }}" class="btn btn-outline-warning @if(Auth::user()->rol == 'O') w-100 @endif ">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                        </svg>
                    </a>
                    @if (Auth::user()->rol == 'A')
                        <a href="#" class="btn btn-outline-danger" data-toggle="modal" data-target="#confirmDeleteModal{{ $user->id }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        @if (Auth::user()->rol == 'A')
        <tr>
            <td colspan="11">
                <a class="btn btn-success w-100" href="{{ route('user.create') }}">
                    Añadir Usuario &nbsp;
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4"/>
                    </svg>
                </a>
            </td>
        </tr>
        @endif
    </tbody>
</table>
@if(Auth::user()->rol == 'A')
    <div class="d-flex justify-content-center">
        {{ $users->links('pagination::bootstrap-4') }}
    </div>
@endif

{{-- Modal --}}
@if(Auth::user()->rol == 'A')
    @foreach ($users as $user)
        <div class="modal fade" id="confirmDeleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel{{ $user->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteModalLabel{{ $user->id }}">Eliminar usuario</h5>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas eliminar el usuario {{ $user->name }}?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endif
@endsection