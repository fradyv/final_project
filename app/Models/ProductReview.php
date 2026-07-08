<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> master
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
<<<<<<< HEAD
=======
    use HasFactory;
    
>>>>>>> master
    protected $fillable = [
        'product_id',
        'user_id',
        'rating',
<<<<<<< HEAD
        'comment',
    ];

    public function digitalProduct()
    {
        return $this->belongsTo(DigitalProduct::class, 'product_id');
=======
        'comment'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
>>>>>>> master
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
