<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CoworkSpace;
use App\Models\Reservation;
use Carbon\Carbon;

class ClientController extends Controller
{
    public function showReservationForm()
    {
        $reservations = Reservation::where('user_id', auth()->id())->get();
        $spaces = CoworkSpace::all();
        return view('client.reservation', compact('spaces', 'reservations'));
    }

    public function showCreateReservationForm()
    {
        $spaces = CoworkSpace::all();
        return view('client.createReservation', compact('spaces'));
    }

    public function makeReservation(Request $request)
    {
        $request->validate([
            'cowork_space_id' => 'required|exists:cowork_spaces,id',
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required|date_format:H:i',
        ]);

        $now = Carbon::now();

        $reservationDate = Carbon::createFromFormat('Y-m-d', $request->reservation_date);
        $reservationTime = Carbon::createFromFormat('H:i', $request->reservation_time);

        $reservationDateTime = $reservationDate->setTime($reservationTime->hour, $reservationTime->minute);

        if ($reservationDateTime->isPast()) {
            return back()->withErrors(['reservation_time' => 'La fecha y hora de la reserva no pueden ser en el pasado.'])->withInput();
        }

        $reservationEndTime = $reservationTime->copy()->addMinutes(59);

        $existingReservation = Reservation::where('cowork_space_id', $request->cowork_space_id)
            ->where('reservation_date', $request->reservation_date)
            ->where(function ($query) use ($reservationTime, $reservationEndTime) {
                $query->whereBetween('reservation_time', [$reservationTime, $reservationEndTime])
                    ->orWhereBetween('reservation_end_time', [$reservationTime, $reservationEndTime]);
            })
            ->where('status', '!=', 'Rechazada') // Excluir las reservas rechazadas
            ->exists();

        if ($existingReservation) {
            return back()->withErrors(['reservation_time' => 'La sala ya está ocupada en ese horario.'])->withInput();
        }

        $reservation = new Reservation();
        $reservation->user_id = auth()->id();
        $reservation->cowork_space_id = $request->cowork_space_id;
        $reservation->reservation_date = $request->reservation_date;
        $reservation->reservation_time = $reservationTime;
        $reservation->reservation_end_time = $reservationEndTime;
        $reservation->status = 'Pendiente';
        $reservation->save();

        return redirect()->route('client.reservation')->with('success', 'Reserva creada con éxito.');
    }

    public function showReservations()
    {
        $reservations = Reservation::where('user_id', auth()->id())->get();
        return view('client.reservations', compact('reservations'));
    }

    public function editReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->reservation_date = Carbon::parse($reservation->reservation_date);
        $reservation->reservation_time = Carbon::parse($reservation->reservation_time);

        $spaces = CoworkSpace::all();

        return view('client.editReservation', compact('reservation', 'spaces'));
    }

    public function deleteReservation($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return redirect()->route('client.reservation')->with('success', 'Reserva eliminada con éxito.');
    }

    public function updateReservation(Request $request, $id)
    {
        $request->validate([
            'cowork_space_id' => 'required|exists:cowork_spaces,id',
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required|date_format:H:i',
        ]);

        $now = Carbon::now();
        $reservationDate = Carbon::createFromFormat('Y-m-d', $request->reservation_date);
        $reservationTime = Carbon::createFromFormat('H:i', $request->reservation_time);
        $reservationDateTime = $reservationDate->setTime($reservationTime->hour, $reservationTime->minute);

        if ($reservationDateTime->isPast()) {
            return back()->withErrors(['reservation_time' => 'La fecha y hora de la reserva no pueden ser en el pasado.'])->withInput();
        }

        $reservation = Reservation::findOrFail($id);
        $reservationEndTime = $reservationTime->copy()->addMinutes(59);
        $reservation->cowork_space_id = $request->cowork_space_id;
        $reservation->reservation_date = $request->reservation_date;
        $reservation->reservation_time = $reservationTime;
        $reservation->reservation_end_time = $reservationEndTime;
        $reservation->status = 'Pendiente';
        $reservation->save();
        return redirect()->route('client.reservation')->with('success', 'Reserva actualizada con éxito.');
    }

}
