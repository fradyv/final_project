<?php

namespace App\Models;

use App\Enums\CampaignStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'fundraiser_id',
        'title',
        'description',
        'target_amount',
        'current_amount',
        'withdrawn_amount',
        'status',
        'end_date',
    ];

    protected function casts(): array
    {
        return [
            'target_amount'    => 'decimal:2',
            'current_amount'   => 'decimal:2',
            'withdrawn_amount' => 'decimal:2',
            'status'           => CampaignStatus::class,
            'end_date'         => 'date',
        ];
    }

    public function fundraiser()
    {
        return $this->belongsTo(Fundraiser::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function withdrawalRequests()
    {
        return $this->hasMany(WithdrawalRequest::class);
    }

    public function availableBalance(): float
    {
        return (float) $this->current_amount - (float) $this->withdrawn_amount;
    }
}
