<?php

namespace App\Models;

use App\Enums\TransactionStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'donor_id',
        'campaign_id',
        'amount',
        'status'
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'status' => TransactionStatus::class

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
