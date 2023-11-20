<?php

namespace App\Http\Controllers\Web;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class HistoryWebController extends Controller
{
    public function getBookings()
    {
        $bookings = Booking::with('user.barangay', 'dropoff.barangay', 'transaction', 'riderdelivery.rider')
        ->whereDate('created_at', Carbon::today())
        ->orderBy('id', 'desc')
        ->get();

        return response()->json($bookings);
    }

    public function updateOutOfDelivery($id, Request $request)
    {
        $booking = Booking::find($id);
        $booking->update([
            'status' => $request->status
        ]);

        return response()->json($booking);
    }
}
