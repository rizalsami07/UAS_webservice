<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return Reservation::with('service')->where('user_id', auth()->id())->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'reservation_date' => 'required|date',
        ]);

        $reservation = Reservation::create([
            'user_id' => auth()->id(),
            'service_id' => $request->service_id,
            'reservation_date' => $request->reservation_date,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Reservation berhasil',
            'data' => $reservation
        ]);
    }

    public function show($id)
    {
        return Reservation::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $reservation->update($request->only('reservation_date', 'status'));

        return response()->json($reservation);
    }

    public function destroy($id)
    {
        Reservation::where('id', $id)
            ->where('user_id', auth()->id())
            ->delete();

        return response()->json(['message' => 'Reservation dihapus']);
    }
}
