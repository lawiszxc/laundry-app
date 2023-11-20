<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KiloServiceProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'transactionID',
        'service',
        'detergent',
        'bleach',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'id');
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
