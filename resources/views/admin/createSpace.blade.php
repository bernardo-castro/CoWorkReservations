@extends('layouts.app')

@section('title', 'Agregar Nuevo Espacio')

@section('content')
<h2 class="text-center">Agregar Nuevo Espacio de Coworking</h2>

<form action="{{ route('admin.storeSpace') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nombre del Espacio</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <textarea class="form-control" id="description" name="description"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Guardar Espacio</button>
</form>
<a href="{{ route('admin.manageSpaces') }}" class="btn btn-secondary mt-3">Volver a las Salas</a>
@endsection
