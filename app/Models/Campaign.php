<?php

namespace App\Models;

use App\Enums\CampaignStatus;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    protected $fillable = [
        'fundraiser_id',
        'title',
        'description',
        'target_amount',
        'collected_amount',
        'status',
        'created',
        'ended',
    ];

    protected function casts(): array
    {
        return [
            'target_amount' => 'decimal:2',
            'collected_amount' => 'decimal:2',
            'status' => CampaignStatus::class,
            'created' => 'datetime',
            'ended' => 'datetime',
        ];
    }

    public function fundraiser()
    {
        return $this->belongsTo(Fundraiser::class);
    }

    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
