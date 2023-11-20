<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaundryKilo extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'price',
    ];

    public function transactionkilo()
    {
        return $this->hasMany(TransactionKilo::class, 'id');
    }

    public function transactionloadkilo()
    {
        return $this->hasMany(TransactionLoadKilo::class, 'id');
    }
}
