<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryLoad extends Model
{
    use HasFactory;

    protected $fillable = [
        'kilo',
        'price',
    ];

    public function transactionload()
    {
        return $this->hasOne(TransactionLoad::class, 'id');
    }

    public function loadkiloserviceproduct()
    {
        return $this->hasOne(LoadKiloServiceProduct::class, 'id');
    }
}
