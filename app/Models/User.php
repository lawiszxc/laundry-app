<?php

namespace App\Models;

use App\Models\Booking;
use App\Models\Barangay;
use App\Models\RiderDelivery;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable, HasFactory;

    protected $fillable = [
        'role',
        'name',
        'email',
        'password',
        'phoneNum',
        'barangayID',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function booking()
    {
        return $this->hasMany(Booking::class, 'id');
    }

    public function remittance()
    {
        return $this->hasMany(Remittance::class, 'id');
    }

    public function barangay()
    {
        return $this->belongsTo(Barangay::class, 'barangayID');
    }

    public function riderdelivery()
    {
        return $this->hasMany(RiderDelivery::class, 'id');
    }
}
