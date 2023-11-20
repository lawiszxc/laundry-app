<?php

namespace App\Http\Controllers\Web;

use App\Models\Booking;
use App\Models\DropOff;
use App\Models\LoadKiloServiceProduct;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\TransactionLoadKilo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TransactionKilo;
use App\Models\TransactionLoad;
use App\Models\KiloServiceProduct;
use App\Http\Controllers\Controller;

class DropOffController extends Controller
{
    public function addDropOff(Request $request)
    {
        $dropOff = DropOff::create([
            'name' => $request->name,
            'phoneNum' => $request->phoneNum,
            'barangayID' => $request->barangayID,
            'bookingType' => $request->bookingType,
        ]);

        $transactionNum = strtoupper(substr(Str::uuid(), 0, 13));

        $booking = Booking::create([
            'transactionNum' => $transactionNum,
            'dropOffID' => $dropOff->id,
            'selectedPickup' => now(),
            'selectedDelivery' => $request->selectedDelivery,
            'homeAddress' => $request->homeAddress,
            'status' => $request->status,
            'totalPrice' => $request->totalPrice,
        ]);

        Payment::create([
            'bookingID' => $booking->id,
            'paymentType' => 'CASH',
            'status' => 'PAID',
        ]);

        $transaction = Transaction::create([
            'bookingID' => $booking->id,
            'transactionType' => $request->transactionType,
        ]);

        if ($request->transactionType === 'LOAD') {
            TransactionLoad::create([
                'transactionID' => $transaction->id,
                'loadID' => '1',
                'load' => $request->load,
                'service' => $request->service,
                'detergent' => $request->detergent,
                'bleach' => $request->bleach,
            ]);
        }

        elseif ($request->transactionType === 'KILO') {
            $laundryKilos = $request->laundryKilos;

            foreach ($laundryKilos as $laundryKilo) {
                TransactionKilo::create([
                    'transactionID' => $transaction->id,
                    'type' => $laundryKilo['type'],
                    'kilo' => $laundryKilo['kilo'],
                ]);
            }

            KiloServiceProduct::create([
                'transactionID' => $transaction->id,
                'service' => $request->service,
                'detergent' => $request->detergent,
                'bleach' => $request->bleach,
            ]);
        }

        elseif ($request->transactionType === 'LOAD AND KILO') {
            $laundryKilos = $request->laundryKilos;

            foreach ($laundryKilos as $laundryKilo) {
                TransactionLoadKilo::create([
                    'transactionID' => $transaction->id,
                    'type' => $laundryKilo['type'],
                    'kilo' => $laundryKilo['kilo'],
                ]);
            }

            LoadKiloServiceProduct::create([
                'transactionID' => $transaction->id,
                'service' => $request->service,
                'detergent' => $request->detergent,
                'bleach' => $request->bleach,
                'loadID' => '1',
                'load' => $request->load,
            ]);
        }

        return response()->json($transaction);
    }

    public function getDropOffName()
    {
        $dropoff = DropOff::groupBy('name')
        ->get();

        return response()->json($dropoff);
    }

    public function getDropOffPhoneNum()
    {
        $dropoff = DropOff::groupBy('phoneNum')
        ->get();

        return response()->json($dropoff);
    }
}
