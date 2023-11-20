<?php

namespace App\Http\Controllers\Web;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class AdminTransactionController extends Controller
{
    public function getBookings()
    {
        $bookings = Booking::with('user.barangay')
        ->where('status', 'PENDING')
        ->get();

        return response()->json($bookings);
    }

    public function updateBooking(Request $request, $id)
    {
        $updateBooking = Booking::find($id);
        $updateBooking->update([
            'status' => $request->status
        ]);

        return response()->json($updateBooking, 200);
    }

    public function bookingStatus()
    {
        $bookingStatus = Booking::whereDate('selectedPickup', Carbon::today())
        ->count();

        $pendingStatus = Booking::where('status', 'PENDING')
        ->whereDate('selectedPickup', Carbon::today())
        ->count();

        $deliveredStatus = Booking::whereIn('status', ['SUCCESSFUL', 'DROP-OFF / DELIVERED SUCCESSFULLY'])
        ->whereDate('created_at', Carbon::today())
        ->count();

        $salesStatus = Booking::whereIn('status', [
            'SUCCESSFUL',
            'DROP-OFF / DELIVERED SUCCESSFULLY',
            'DROP-OFF / SUCCESSFULLY PICKED UP',
            ])
        ->count();

        return response()->json([
            'bookingCount' => $bookingStatus,
            'pendingCount' => $pendingStatus,
            'deliveredCount' => $deliveredStatus,
            'salesCount' => $salesStatus,
        ]);
    }
}
