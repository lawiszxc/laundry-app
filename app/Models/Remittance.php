<?php

namespace App\Models;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Remittance extends Model
{
    use HasFactory;

    protected $fillable = [
        'userID',
        'bookingID',
        'collected',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userID');
    }

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'bookingID');
    }
}
