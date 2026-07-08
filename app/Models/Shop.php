<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> master
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
<<<<<<< HEAD
    protected $fillable = [
        'user_id',
        'product_name',
        'description',
=======
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'name',
        'description'
>>>>>>> master
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

<<<<<<< HEAD
    public function digitalProducts()
    {
        return $this->hasMany(DigitalProduct::class);
=======
    public function products()
    {
        return $this->hasMany(Product::class);
>>>>>>> master
    }
}
