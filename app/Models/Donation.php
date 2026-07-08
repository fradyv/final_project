<?php

namespace App\Models;

<<<<<<< HEAD
use App\Enums\DonationStatus;
=======
use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> master
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
<<<<<<< HEAD
=======
    use HasFactory;
    
>>>>>>> master
    protected $fillable = [
        'donor_id',
        'campaign_id',
        'amount',
<<<<<<< HEAD
        'status',
=======
        'status'
>>>>>>> master
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
<<<<<<< HEAD
            'status' => DonationStatus::class,
=======
            'status' => TransactionStatus::class

>>>>>>> master
        ];
    }

    public function donor()
    {
        return $this->belongsTo(User::class, 'donor_id');
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
