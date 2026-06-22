<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
        'comment',
    ];

    public function digitalProduct()
    {
        return $this->belongsTo(DigitalProduct::class, 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
