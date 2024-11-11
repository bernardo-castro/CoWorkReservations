@extends('layouts.app')

@section('title', 'Editar Reserva')

@section('content')
<div class="container">
    <h2 class="text-center">Editar Reserva</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('client.updateReservation', $reservation->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="cowork_space_id">Selecciona un espacio de coworking:</label>
            <select name="cowork_space_id" id="cowork_space_id" class="form-control" required>
                <option value="">Selecciona un espacio</option>
                @foreach($spaces as $space)
                <option value="{{ $space->id }}" {{ $space->id == $reservation->cowork_space_id ? 'selected' : '' }}>
                    {{ $space->name }}
                </option>
                @endforeach
            </select>
            @error('cowork_space_id')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="reservation_date">Fecha de la Reserva:</label>
            <input type="date" name="reservation_date" id="reservation_date" class="form-control"
                value="{{ $reservation->reservation_date->format('Y-m-d') }}" required>
            @error('reservation_date')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="reservation_time">Hora de la Reserva:</label>
            <input type="time" name="reservation_time" id="reservation_time" class="form-control"
                value="{{ $reservation->reservation_time->format('H:i') }}" required>
            @error('reservation_time')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Actualizar Reserva</button>
        </div>
    </form>

    <div class="form-group mt-3">
        <a href="{{ route('client.reservation') }}" class="btn btn-secondary">Volver a mis reservas</a>
    </div>
</div>
@endsection