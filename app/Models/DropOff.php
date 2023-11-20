<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DropOff extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'barangayID',
        'bookingType',
        'phoneNum',
    ];

    public function booking()
    {
        return $this->hasOne(Booking::class, 'id');
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class, 'barangayID');
    }
}
