@extends('layouts.app')

@section('title', 'Editar Sala')

@section('content')
<h2 class="text-center">Editar Sala de Coworking</h2>

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<form action="{{ route('admin.updateSpace', $coworkSpace->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Nombre de la Sala</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $coworkSpace->name) }}"
            required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Descripción</label>
        <textarea class="form-control" id="description"
            name="description">{{ old('description', $coworkSpace->description) }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar Sala</button>
</form>

<a href="{{ route('admin.manageSpaces') }}" class="btn btn-secondary mt-3">Volver a las Salas</a>

@endsection