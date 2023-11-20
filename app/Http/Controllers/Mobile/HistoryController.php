<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Booking;
use App\Models\Remittance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function userHistory()
    {
        $auth = Auth::user()->id;

        $booking = Booking::with(
        'user.barangay',
        'transaction.transactionload.loadid',
        'transaction.transactionload.service',
        'transaction.transactionload.detergent',
        'transaction.transactionload.bleach',
        'transaction.transactionkilo.laundrykilo',
        'transaction.kiloserviceproduct.service',
        'transaction.kiloserviceproduct.detergent',
        'transaction.kiloserviceproduct.bleach',
        'transaction.loadkiloserviceproduct.loadid',
        'transaction.transactionloadkilo.laundrykilo',
        'transaction.loadkiloserviceproduct.service',
        'transaction.loadkiloserviceproduct.detergent',
        'transaction.loadkiloserviceproduct.bleach',
        )
        ->where('userID', $auth)
        ->orderBy('created_at', 'desc')
        ->get();

        return response()->json($booking);
    }

    public function riderHistory()
    {
        $booking = Booking::with('user' ,'transaction', 'dropoff')
        ->where('status', '!=', 'DECLINED')
        ->where('status', '!=', 'DROP-OFF / READY TO PICKUP')
        ->where('status', '!=', 'DROP-OFF / OUT FOR DELIVERY')
        ->where('status', '!=', 'DROP-OFF / PICKUP PENDING')
        ->where('status', '!=', 'DROP-OFF / DELIVERY PENDING')
        ->where('status', '!=', 'DROP-OFF / SUCCESSFULLY PICKED UP')
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy(function ($booking) {
            return $booking->created_at->format('Y-m-d');
        });

        return response()->json($booking);
    }


    public function collectionHistory()
    {
        $booking = Booking::with(
            'user',
            'dropoff',
            'transaction.transactionload.loadid',
            'transaction.transactionload.service',
            'transaction.transactionload.detergent',
            'transaction.transactionload.bleach',
            'transaction.transactionkilo.laundrykilo',
            'transaction.kiloserviceproduct.service',
            'transaction.kiloserviceproduct.detergent',
            'transaction.kiloserviceproduct.bleach',
            'transaction.loadkiloserviceproduct.loadid',
            'transaction.transactionloadkilo.laundrykilo',
            'transaction.loadkiloserviceproduct.service',
            'transaction.loadkiloserviceproduct.detergent',
            'transaction.loadkiloserviceproduct.bleach',
            )
        ->whereIn('status', ['SUCCESSFUL', 'DROP-OFF / SUCCESSFULLY PICKED UP', 'DROP-OFF / DELIVERED SUCCESSFULLY'])
        ->whereDate('created_at', now()->toDateString())
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy(function ($booking) {
            return $booking->created_at->format('Y-m-d');
        });

        return response()->json($booking);
    }

    public function riderRemitted()
    {
        $auth = Auth::user()->id;

        $remitted = Remittance::with('user')
        ->where('userID', $auth)
        ->selectRaw('userID, SUM(collected) as remittedTotal')
        ->selectRaw('userID, (status) as remittedStatus')
        ->whereDate('created_at', Carbon::today())
        ->get();

        return response()->json($remitted);
    }
}
