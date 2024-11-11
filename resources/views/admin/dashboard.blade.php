@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<h2 class="text-center">Bienvenido al Dashboard de Administrador</h2>

<div class="row mt-4">
    <!-- Gestión de Espacios de Coworking -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Gestión de Espacios de Coworking
            </div>
            <div class="card-body">
                <p class="card-text">Aquí puedes ver, agregar y editar los espacios de coworking disponibles para los
                    clientes.</p>
                <a href="{{ route('admin.manageSpaces') }}" class="btn btn-primary">Ver Espacios</a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Gestión de Reservas
            </div>
            <div class="card-body">
                <p class="card-text">Aquí puedes ver, aprobar o rechazar las reservas hechas por los clientes.</p>
                <a href="{{ route('admin.manageReservations') }}" class="btn btn-primary">Ver Reservas</a>
            </div>
        </div>
    </div>
</div>
@endsection
