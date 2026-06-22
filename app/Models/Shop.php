<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = [
        'user_id',
        'product_name',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function digitalProducts()
    {
        return $this->hasMany(DigitalProduct::class);
    }
}
