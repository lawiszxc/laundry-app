<?php

namespace App\Models;

use App\Models\User;
use App\Models\Transaction;
use App\Models\RiderDelivery;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'transactionNum',
        'userID',
        'dropOffID',
        'selectedPickup',
        'selectedDelivery',
        'homeAddress',
        'status',
        'totalPrice',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function dropoff()
    {
        return $this->belongsTo(DropOff::class, 'dropOffID');
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class, 'bookingID');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'bookingID');
    }

    public function riderdelivery()
    {
        return $this->hasOne(RiderDelivery::class, 'bookingID');
    }

    public function remittance()
    {
        return $this->hasMany(Remittance::class, 'id');
    }
}
