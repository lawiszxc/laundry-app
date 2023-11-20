<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class ReportsController extends Controller
{
    public function reports()
    {
        $weekly = Booking::with('transaction', 'payment')
        ->with(['user' => function ($query) {
            $query->where('role', 'USER');
        }])
        ->whereBetween('created_at',
        [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->where('status', 'SUCCESSFUL')
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy('user.name');


        $monthly = Booking::with('transaction', 'payment')
        ->with(['user' => function ($query) {
            $query->where('role', 'USER');
        }])
        ->whereMonth('created_at', Carbon::now()->month)
        ->where('status', 'SUCCESSFUL')
        ->get()
        ->groupBy('user.name');


        $yearly = Booking::with('transaction', 'payment')
        ->with(['user' => function ($query) {
            $query->where('role', 'USER');
        }])
        ->whereBetween('created_at', [
            Carbon::now()->startOfYear(),
            Carbon::now()->endOfYear(),
        ])
        ->where('status', 'SUCCESSFUL')
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy('user.name');


        $weeklySum = Booking::whereIn('status', ['SUCCESSFUL', 'DROP-OFF / SUCCESSFULLY PICKED UP', 'DROP-OFF / DELIVERED SUCCESSFULLY'])
        ->whereBetween('created_at',
        [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->sum('totalPrice');

        $monthlySum = Booking::whereIn('status', ['SUCCESSFUL', 'DROP-OFF / SUCCESSFULLY PICKED UP', 'DROP-OFF / DELIVERED SUCCESSFULLY'])
        ->whereMonth('created_at', Carbon::now()->month)
        ->sum('totalPrice');

        $yearlySum = Booking::whereIn('status', ['SUCCESSFUL', 'DROP-OFF / SUCCESSFULLY PICKED UP', 'DROP-OFF / DELIVERED SUCCESSFULLY'])
        ->whereBetween('created_at', [
            Carbon::now()->startOfYear(),
            Carbon::now()->endOfYear(),
        ])->sum('totalPrice');


        $weeklyDropOff = Booking::with('transaction', 'payment')
        ->whereBetween('created_at',
        [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->whereIn('status', ['DROP-OFF / DELIVERED SUCCESSFULLY', 'DROP-OFF / SUCCESSFULLY PICKED UP'])
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy('dropoff.name');


        $monthlyDropOff = Booking::with('transaction', 'payment')
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereIn('status', ['DROP-OFF / DELIVERED SUCCESSFULLY', 'DROP-OFF / SUCCESSFULLY PICKED UP'])
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy('dropoff.name');


        $yearlyDropOff = Booking::with('transaction', 'payment')
        ->whereBetween('created_at', [
            Carbon::now()->startOfYear(),
            Carbon::now()->endOfYear(),
        ])
        ->whereIn('status', ['DROP-OFF / DELIVERED SUCCESSFULLY', 'DROP-OFF / SUCCESSFULLY PICKED UP'])
        ->orderBy('created_at', 'desc')
        ->get()
        ->groupBy('dropoff.name');

        $weeklyTransaction = Booking::with('user', 'dropoff')
        ->whereBetween('created_at',
        [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->whereIn('status', ['SUCCESSFUL', 'DROP-OFF / DELIVERED SUCCESSFULLY', 'DROP-OFF / SUCCESSFULLY PICKED UP'])
        ->orderBy('created_at', 'desc')
        ->get();

        $monthlyTransaction = Booking::with('user', 'dropoff')
        ->whereMonth('created_at', Carbon::now()->month)
        ->whereIn('status', ['SUCCESSFUL', 'DROP-OFF / DELIVERED SUCCESSFULLY', 'DROP-OFF / SUCCESSFULLY PICKED UP'])
        ->orderBy('created_at', 'desc')
        ->get();

        $yearlyTransaction = Booking::with('user', 'dropoff')
        ->whereBetween('created_at', [
            Carbon::now()->startOfYear(),
            Carbon::now()->endOfYear(),
        ])
        ->whereIn('status', ['SUCCESSFUL', 'DROP-OFF / DELIVERED SUCCESSFULLY', 'DROP-OFF / SUCCESSFULLY PICKED UP'])
        ->orderBy('created_at', 'desc')
        ->get();

        return response()->json([
            'weekly' => $weekly,
            'monthly' => $monthly,
            'yearly' => $yearly,
            'weeklySum' => $weeklySum,
            'monthlySum' => $monthlySum,
            'yearlySum' => $yearlySum,
            'weeklyDropOff' => $weeklyDropOff,
            'monthlyDropOff' => $monthlyDropOff,
            'yearlyDropOff' => $yearlyDropOff,
            'weeklyTransaction' => $weeklyTransaction,
            'monthlyTransaction' => $monthlyTransaction,
            'yearlyTransaction' => $yearlyTransaction,
        ]);
    }
}
