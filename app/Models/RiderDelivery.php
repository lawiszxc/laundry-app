<?php

namespace App\Models;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RiderDelivery extends Model
{
    use HasFactory;

    protected $fillable = [
        'bookingID',
        'riderID',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class. 'id');
    }

    public function rider()
    {
        return $this->belongsTo(User::class, 'riderID');
    }
}
