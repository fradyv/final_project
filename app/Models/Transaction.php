<?php

namespace App\Models;

use App\Enums\TransactionStatus;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> master
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
<<<<<<< HEAD
=======
    use HasFactory;
    
>>>>>>> master
    protected $fillable = [
        'buyer_id',
        'product_id',
        'amount',
        'bank_name',
        'payment_time',
<<<<<<< HEAD
        'status',
=======
        'status'
>>>>>>> master
    ];

    protected function casts(): array
    {
        return [
<<<<<<< HEAD
            'amount' => 'decimal:2',
            'payment_time' => 'datetime',
            'status' => TransactionStatus::class,
=======
            'amount'=>'decimal:2',
            'payment_time'=>'datetime',
            'status'=>TransactionStatus::class
>>>>>>> master
        ];
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
<<<<<<< HEAD

    public function digitalProduct()
    {
        return $this->belongsTo(DigitalProduct::class, 'product_id');
=======
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
>>>>>>> master
    }
}
