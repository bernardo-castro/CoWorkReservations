@extends('layouts.app')

@section('title', 'Crear Reserva')

@section('content')
<div class="container">
    <h2 class="text-center">Crear Reserva</h2>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('client.createReservation') }}" method="POST">
        @csrf

        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    <label for="cowork_space_id">Selecciona una Sala:</label>
                    <select name="cowork_space_id" id="cowork_space_id" class="form-control" required>
                        <option value="">Selecciona una Sala</option>
                        @foreach($spaces as $space)
                        <option value="{{ $space->id }}">{{ $space->name }}</option>
                        @endforeach
                    </select>
                    @error('cowork_space_id')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <label for="reservation_date">Fecha de la Reserva:</label>
                <input type="date" name="reservation_date" id="reservation_date" class="form-control" required
                    min="{{ \Carbon\Carbon::now()->addHour()->toDateString() }}"
                    value="{{ \Carbon\Carbon::now()->addHour()->toDateString() }}">
                @error('reservation_date')
                <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="form-group">
                    <label for="reservation_time">Hora de la Reserva:</label>
                    <input type="time" name="reservation_time" id="reservation_time" class="form-control" required
                        value="{{ \Carbon\Carbon::now()->addHour()->format('H:i') }}">

                    @error('reservation_time')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Crear Reserva</button>
        </div>
    </form>

    <div class="form-group mt-3">
        <a href="{{ route('client.reservation') }}" class="btn btn-secondary">Volver a mis reservas</a>
    </div>
</div>
@endsection
