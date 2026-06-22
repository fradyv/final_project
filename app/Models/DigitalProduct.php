<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DigitalProduct extends Model
{
    protected $fillable = [
        'shop_id',
        'title',
        'description',
        'price',
        'stock',
        'product_preview',
        'category',
        'file_url',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'product_id');
    }

    public function productReviews()
    {
        return $this->hasMany(ProductReview::class, 'product_id');
    }
}
