<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    use HasFactory;

    protected $fillable = [
        'barangay',
        'price',
    ];

    public function user()
    {
        return $this->hasMany(User::class, 'id');
    }

    public function dropoff()
    {
        return $this->hasMany(DropOff::class, 'id');
    }
}
