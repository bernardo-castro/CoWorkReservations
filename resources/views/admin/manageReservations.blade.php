@extends('layouts.app')

@section('title', 'Gestionar Reservas')

@section('content')
<h2 class="text-center">Gestionar Reservas</h2>

<div class="container">
    <form action="{{ route('admin.manageReservations') }}" method="GET" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="cowork_space_id" class="form-control">
                    <option value="">Seleccionar Sala</option>
                    @foreach($coworkSpaces as $space)
                    <option value="{{ $space->id }}" {{ request('cowork_space_id') == $space->id ? 'selected' : '' }}>
                        {{ $space->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Espacio</th>
                <th>Fecha</th>
                <th>Hora de Inicio</th>
                <th>Hora de Fin</th>
                <th>Estado</th>
                <th>Nombre del Usuario</th>
                <th>Correo del Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reservations as $reservation)
            <tr>
                <td>{{ $reservation->id }}</td>
                <td>{{ $reservation->coworkSpace->name }}</td>
                <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}</td>
                <td>{{ \Carbon\Carbon::parse($reservation->reservation_end_time)->format('H:i') }}</td>
                <td>{{ $reservation->status }}</td>
                <td>{{ $reservation->user->name }}</td>
                <td>{{ $reservation->user->email }}</td>
                <td>
                    @if($reservation->status == 'Pendiente')
                    <form action="{{ route('admin.updateStatus', $reservation->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="status" value="Aceptada">
                        <button type="submit" class="btn btn-success">Aceptar</button>
                    </form>

                    <form action="{{ route('admin.updateStatus', $reservation->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('POST')
                        <input type="hidden" name="status" value="Rechazada">
                        <button type="submit" class="btn btn-danger">Rechazar</button>
                    </form>
                    @elseif($reservation->status == 'Confirmada')
                    <p class="text-success">¡Reserva Confirmada!</p>
                    @elseif($reservation->status == 'Cancelada')
                    <p class="text-muted">Reserva Cancelada</p>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary mt-3">Volver al Dashboard</a>
</div>

@endsection
