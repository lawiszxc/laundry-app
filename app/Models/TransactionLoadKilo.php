<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionLoadKilo extends Model
{
    use HasFactory;

    protected $fillable = [
        'transactionID',
        'type',
        'kilo',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'id');
    }

    public function laundrykilo()
    {
        return $this->belongsTo(LaundryKilo::class, 'type');
    }

    public function loadid()
    {
        return $this->belongsTo(LaundryLoad::class, 'loadID');
    }
}
