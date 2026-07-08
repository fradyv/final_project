<?php

namespace App\Models;

<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> master
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
<<<<<<< HEAD
    protected $fillable = [
        'user_id',
=======
    use HasFactory;

    protected $fillable = [
        'fundraiser_id',
>>>>>>> master
        'balance',
    ];

    protected function casts(): array
    {
        return [
            'balance' => 'decimal:2',
        ];
    }

<<<<<<< HEAD
    public function user()
    {
        return $this->belongsTo(User::class);
=======
    public function fundraiser()
    {
        return $this->belongsTo(Fundraiser::class);
>>>>>>> master
    }
}
