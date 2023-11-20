<?php

namespace App\Models;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'bookingID',
        'transactionType',
        'totalPrice',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'id');
    }

    public function transactionkilo()
    {
        return $this->hasMany(TransactionKilo::class, 'transactionID');
    }

    public function transactionload()
    {
        return $this->hasOne(TransactionLoad::class, 'transactionID');
    }

    public function transactionloadkilo()
    {
        return $this->hasMany(TransactionLoadKilo::class, 'transactionID');
    }

    public function kiloserviceproduct()
    {
        return $this->hasOne(KiloServiceProduct::class, 'transactionID');
    }

    public function loadkiloserviceproduct()
    {
        return $this->hasOne(LoadKiloServiceProduct::class, 'transactionID');
    }
}
