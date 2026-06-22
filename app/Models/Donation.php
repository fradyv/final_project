<?php

namespace App\Models;

use App\Enums\DonationStatus;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = [
        'donor_id',
        'campaign_id',
        'amount',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'status' => DonationStatus::class,
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
