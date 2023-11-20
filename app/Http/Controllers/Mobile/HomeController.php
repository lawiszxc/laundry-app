<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function bookingStatus()
    {
        $pendingStatus = Booking::where('status', 'ACCEPTED')
        ->whereDate('selectedPickup', Carbon::today())
        ->count();

        $deliveryStatus = Booking::where('status', 'CONFIRMED')
        ->whereDate('selectedDelivery', Carbon::today())
        ->count();

        $collectionSum = Booking::where('status', 'SUCCESSFUL')
        ->whereDate('selectedDelivery', Carbon::today())
        ->SUM('totalPrice');

        return response()->json([
            'pendingCount' => $pendingStatus,
            'deliveryCount' => $deliveryStatus,
            'collectionSum' => $collectionSum
        ]);
    }
}
