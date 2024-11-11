<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\CoworkSpace;

class ReservationController extends Controller
{
    public function manageReservations(Request $request)
    {
        $query = Reservation::with('coworkSpace', 'user');

        if ($request->has('cowork_space_id') && $request->cowork_space_id != '') {
            $query->where('cowork_space_id', $request->cowork_space_id);
        }

        $reservations = $query->orderBy('reservation_date', 'asc')
                            ->orderBy('reservation_time', 'asc')
                            ->get();

        $coworkSpaces = CoworkSpace::all();

        return view('admin.manageReservations', compact('reservations', 'coworkSpaces'));
    }

    public function cancel(Reservation $reservation)
    {
        $reservation->status = 'Cancelada';
        $reservation->save();
        return redirect()->route('admin.manageReservations')->with('success', 'Reserva cancelada con éxito.');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->status = $request->input('status');
        $reservation->save();
        return redirect()->route('admin.manageReservations')->with('success', 'Estado de la reserva actualizado');
    }
}