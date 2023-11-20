<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bleach extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'price',
    ];

    public function kiloserviceproduct()
    {
        return $this->hasOne(KiloServiceProduct::class, 'id');
    }

    public function loadkiloserviceproduct()
    {
        return $this->hasOne(LoadKiloServiceProduct::class, 'id');
    }
}
