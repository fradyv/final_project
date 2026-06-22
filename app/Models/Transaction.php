<?php

namespace App\Models;

use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'buyer_id',
        'product_id',
        'amount',
        'bank_name',
        'payment_time',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'payment_time' => 'datetime',
            'status' => TransactionStatus::class,
        ];
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function digitalProduct()
    {
        return $this->belongsTo(DigitalProduct::class, 'product_id');
    }
}
