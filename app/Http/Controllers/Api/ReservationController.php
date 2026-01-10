<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return response()->json(
            Reservation::with(['user', 'service'])->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'reservation_date' => 'required|date',
            'status' => 'in:pending,confirmed,cancelled'
        ]);

        $reservation = Reservation::create([
            'user_id' => auth()->id(),
            'service_id' => $request->service_id,
            'reservation_date' => $request->reservation_date,
            'status' => $request->status ?? 'pending'
        ]);

        return response()->json([
            'message' => 'Reservasi berhasil dibuat',
            'data' => $reservation
        ], 201);
    }

    public function show($id)
    {
        return response()->json(
            Reservation::with(['user', 'service'])->findOrFail($id)
        );
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $reservation->update($request->only([
            'service_id',
            'reservation_date',
            'status'
        ]));

        return response()->json([
            'message' => 'Reservasi berhasil diupdate',
            'data' => $reservation
        ]);
    }

    public function destroy($id)
    {
        Reservation::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Reservasi berhasil dihapus'
        ]);
    }
}
