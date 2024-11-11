@extends('layouts.app')

@section('title', 'Gestionar Salas')

@section('content')
<h2 class="text-center">Gestionar Salas de Coworking</h2>

<div class="container">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($spaces as $space)
            <tr>
                <td>{{ $space->name }}</td>
                <td>{{ $space->description ?? 'No hay descripción.' }}</td>
                <td>
                    <a href="{{ route('admin.editSpace', $space->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('admin.deleteSpace', $space->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.createSpace') }}" class="btn btn-success mt-3">Crear Nueva Sala</a>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">Volver al Dashboard</a>
</div>

@endsection
