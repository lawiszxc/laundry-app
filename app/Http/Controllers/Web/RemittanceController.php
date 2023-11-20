<?php

namespace App\Http\Controllers\Web;

use App\Models\Booking;
use App\Models\DropOff;
use App\Models\Payment;
use App\Models\Remittance;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class RemittanceController extends Controller
{
    public function getRemittances()
    {
        $remittances = Remittance::with('booking.user', 'user')
        ->whereDate('created_at', Carbon::today())
        ->get();

        $totals = $remittances->groupBy('userID')
        ->map(function ($group) {
            return $group->sum('collected');
        });


        return response()->json([
            'remittances' => $remittances,
            'totals' => $totals,
        ]);
    }

    public function getGcashRemittance()
    {
        $remittances = Payment::with('booking.user')
        ->whereDate('created_at', Carbon::today())
        ->where('paymentType', 'GCash')
        ->get();

        return response()->json($remittances);
    }

    public function getRemittancesDropoff()
    {
        $remittancesDropoff = DropOff::withSum('booking', 'totalPrice')
        ->with('booking')
        ->groupBy('name')
        ->whereDate('created_at', Carbon::today())
        ->get();

        return response()->json($remittancesDropoff);
    }

    public function getRemittancesHistory()
    {
        $remittancesDropoff = Booking::with('user', 'dropoff')
            ->whereIn('status', ['SUCCESSFUL', 'DROP-OFF / SUCCESSFULLY PICKED UP', 'DROP-OFF / DELIVERED SUCCESSFULLY'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy(function ($item) {
                return $item->created_at->format('Y-m-d');
            });

        return response()->json($remittancesDropoff);
    }

    public function updateRemittanceStatus($id)
    {
        $updateRemittanceStatus = Remittance::where('userID', $id)->update(['status' => 'Collected']);

        return response()->json($updateRemittanceStatus);
    }

    public function remittedTotal()
    {
        $remittedCollectedTotal = Remittance::where('status', 'Collected')
        ->whereDate('created_at', Carbon::today())
        ->sum('collected');

        $remittanceTotal = Remittance::whereDate('created_at', Carbon::today())
        ->sum('collected');

        $bookingCollectedTotal = Booking::whereIn('status', ['DROP-OFF / DELIVERED SUCCESSFULLY', 'DROP-OFF / SUCCESSFULLY PICKED UP'])
        ->whereDate('created_at', Carbon::today())
        ->sum('totalPrice');

        $totalCollected = $remittanceTotal + $bookingCollectedTotal;

        return response()->json([
            'remittanceTotal' => $remittanceTotal,
            'remittanceCollectedTotal' => $remittedCollectedTotal,
            'totalCollected' => $totalCollected,
        ]);
    }
}
