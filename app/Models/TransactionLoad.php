<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionLoad extends Model
{
    use HasFactory;

    protected $fillable = [
        'transactionID',
        'loadID',
        'load',
        'service',
        'detergent',
        'bleach',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transactionID');
    }

    public function loadid()
    {
        return $this->belongsTo(LaundryLoad::class, 'loadID');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service');
    }

    public function detergent()
    {
        return $this->belongsTo(Detergent::class, 'detergent');
    }

    public function bleach()
    {
        return $this->belongsTo(Bleach::class, 'bleach');
    }
}
