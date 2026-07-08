<?php

namespace App\Models;

use App\Enums\CampaignStatus;
<<<<<<< HEAD
=======
use Illuminate\Database\Eloquent\Factories\HasFactory;
>>>>>>> master
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
<<<<<<< HEAD
=======
    use HasFactory;

>>>>>>> master
    protected $fillable = [
        'fundraiser_id',
        'title',
        'description',
        'target_amount',
<<<<<<< HEAD
        'collected_amount',
        'status',
        'created',
        'ended',
=======
        'current_amount',
        'withdrawn_amount',
        'status',
        'end_date',
>>>>>>> master
    ];

    protected function casts(): array
    {
        return [
<<<<<<< HEAD
            'target_amount' => 'decimal:2',
            'collected_amount' => 'decimal:2',
            'status' => CampaignStatus::class,
            'created' => 'datetime',
            'ended' => 'datetime',
=======
            'target_amount'    => 'decimal:2',
            'current_amount'   => 'decimal:2',
            'withdrawn_amount' => 'decimal:2',
            'status'           => CampaignStatus::class,
            'end_date'         => 'date',
>>>>>>> master
        ];
    }

    public function fundraiser()
    {
        return $this->belongsTo(Fundraiser::class);
    }

<<<<<<< HEAD
    public function donations()
    {
        return $this->hasMany(Donation::class);
=======
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
>>>>>>> master
    }
}
