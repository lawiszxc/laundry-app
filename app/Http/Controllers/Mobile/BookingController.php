<?php

namespace App\Http\Controllers\Mobile;

use App\Models\Booking;
use App\Models\KiloServiceProduct;
use App\Models\LoadKiloServiceProduct;
use App\Models\Payment;
use App\Models\Remittance;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\TransactionKilo;
use App\Models\TransactionLoad;
use App\Models\TransactionLoadKilo;
use App\Http\Controllers\Controller;
use App\Models\RiderDelivery;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function bookings()
    {
        $bookings = Booking::with('user.barangay')
        ->where('status', 'ACCEPTED')
        ->whereDate('selectedPickup', Carbon::today())
        ->orderBy('selectedPickup', 'asc')
        ->get();

        return response()->json($bookings, 200);
    }

    public function addBooking(Request $request)
    {
        $transactionNum = strtoupper(substr(Str::uuid(), 0, 13));

        $booking = Booking::create([
            'transactionNum' => $transactionNum,
            'userID' => $request->userID,
            'selectedPickup' => $request->selectedPickup,
            'selectedDelivery' => $request->selectedDelivery,
            'homeAddress' => $request->homeAddress,
            'status' => 'PENDING',
        ]);

        return response()->json($booking, 200);
    }

    public function driverLoadTransaction(Request $request, $id)
    {

        $updateBooking = Booking::find($id);
        $updateBooking->update([
            'status' => 'USER CONFIRMATION',
        ]);

        $driverLoadTransaction = Transaction::create([
            'bookingID' => $request->bookingID,
            'transactionType' => $request->transactionType,
        ]);

        TransactionLoad::create([
            'transactionID' => $driverLoadTransaction->id,
            'loadID' => $request->loadID,
            'load' => $request->load,
            'service' => $request->service,
            'detergent' => $request->detergent,
            'bleach' => $request->bleach,
        ]);

        return response()->json($driverLoadTransaction);
    }

    public function driverKiloTransaction(Request $request, $id)
    {
        $updateBooking = Booking::find($id);
        $updateBooking->update([
            'status' => 'USER CONFIRMATION',
        ]);

        $driverKiloTransaction = Transaction::create([
            'bookingID' => $request->bookingID,
            'transactionType' => $request->transactionType,
        ]);

        $laundryKilos = $request->laundryKilos;

        foreach ($laundryKilos as $laundryKilo) {
            TransactionKilo::create([
                'transactionID' => $driverKiloTransaction->id,
                'type' => $laundryKilo['type'],
                'kilo' => $laundryKilo['kilo'],
            ]);
        }

        KiloServiceProduct::create([
            'transactionID' => $driverKiloTransaction->id,
            'service' => $request->service,
            'detergent' => $request->detergent,
            'bleach' => $request->bleach,
        ]);
    }

    public function driverLoadKiloTransaction(Request $request, $id)
    {
        $updateBooking = Booking::find($id);
        $updateBooking->update([
            'status' => 'USER CONFIRMATION',
        ]);

        $driverLoadKiloTransaction = Transaction::create([
            'bookingID' => $request->bookingID,
            'transactionType' => $request->transactionType,
        ]);

        $laundryKilos = $request->laundryKilos;

        foreach ($laundryKilos as $laundryKilo) {
            TransactionLoadKilo::create([
                'transactionID' => $driverLoadKiloTransaction->id,
                'type' => $laundryKilo['type'],
                'kilo' => $laundryKilo['kilo'],
            ]);
        }

        LoadKiloServiceProduct::create([
            'transactionID' => $driverLoadKiloTransaction->id,
            'loadID' => $request->loadID,
            'load' => $request->load,
            'service' => $request->service,
            'detergent' => $request->detergent,
            'bleach' => $request->bleach,
        ]);
    }

    public function bookingStatus()
    {
        $auth = Auth::user()->id;

        $bookingStatus = Booking::with('user.barangay')
        ->with(
        'transaction.transactionkilo.laundrykilo',
        'transaction.kiloserviceproduct.service',
        'transaction.kiloserviceproduct.detergent',
        'transaction.kiloserviceproduct.bleach',
        'payment',
        )
        ->with(
            'transaction.transactionload.loadID',
            'transaction.transactionload.service',
            'transaction.transactionload.detergent',
            'transaction.transactionload.bleach',
        )
        ->with(
            'transaction.loadkiloserviceproduct.loadid',
            'transaction.transactionloadkilo.laundrykilo',
            'transaction.loadkiloserviceproduct.service',
            'transaction.loadkiloserviceproduct.detergent',
            'transaction.loadkiloserviceproduct.bleach',
        )
        ->where('userID', $auth)
        ->whereDate('created_at', Carbon::today())
        ->latest('id')
        ->first();


        return response()->json($bookingStatus);
    }

    public function userConfirmation(Request $request, $id)
    {
        $updateBooking = Booking::find($id);
        $updateBooking->update([
            'status' => 'CONFIRMED',
            'totalPrice' => $request->totalPrice,
        ]);

        $paymentStatus = ($request->paymentType === 'GCash') ? 'PAID' : 'UNPAID';

        Payment::create([
            'bookingID' => $updateBooking->id,
            'paymentType' => $request->paymentType,
            'gcashReferenceNum' => $request->gcashReferenceNum,
            'status' => $paymentStatus,
        ]);
    }

    public function driverDelivery()
    {
        $bookings = Booking::with(
            'user.barangay',
            'payment', 'dropoff.barangay',
            )
        ->where('status', 'DROP-OFF / OUT FOR DELIVERY')
        ->orWhere('status', 'OUT FOR DELIVERY')
        ->whereDate('selectedDelivery', Carbon::today())
        ->orderBy('selectedDelivery', 'asc')
        ->get();

        return response()->json($bookings, 200);
    }

    public function driverSuccess(Request $request, $id)
    {
        if ($request->typeOfPayment === 'COD') {
            Remittance::create([
                'userID' => $request->user,
                'bookingID' => $request->bookingID,
                'collected' => $request->collected
            ]);
        }

        $updateBooking = Booking::find($id);
        $updateBooking->update([
            'status' => $request->status,
        ]);

        $updateBooking->payment->update([
            'status' => 'PAID',
        ]);

        $userId = Auth::user()->id;

        RiderDelivery::create([
            'bookingID' => $request->bookingID,
            'riderID' => $userId,
        ]);

        return response()->json('Successful', 200);
    }
}
