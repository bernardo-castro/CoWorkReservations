@extends('layouts.app')

@section('title', 'Mis reservas')

@section('content')
<h2 class="text-center">Mis reservas</h2>

@if($reservations->isEmpty())
<div class="alert alert-info text-center">
    No tienes reservas en este momento.
</div>
@else
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reservations as $reservation)
        <tr>
            <td>{{ $reservation->coworkSpace->name }}</td>
            <td>{{ $reservation->coworkSpace->description ?? 'Sin descripción.' }}</td>
            <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d') }}</td>
            <td>{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i') }}</td>
            <td>{{ $reservation->status }}</td>
            <td>
                <a href="{{ route('client.editReservation', $reservation->id) }}"
                    class="btn btn-warning btn-sm">Editar</a>

                <form action="{{ route('client.deleteReservation', $reservation->id) }}" method="POST"
                    style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm"
                        onclick="return confirm('¿Estás seguro de que deseas eliminar esta reserva?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

<a href="{{ route('client.createReservation') }}" class="btn btn-success mt-3">Reservar una Sala</a>
@endsection
