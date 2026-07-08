<?php

namespace App\Models;

use App\Enums\WithdrawalStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WithdrawalRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'fundraiser_id',
        'campaign_id',
        'amount',
        'bank_name',
        'bank_account_number',
        'bank_account_name',
        'status',
        'admin_notes',
        'reviewed_by',
        'reviewed_at',
    ];

    protected function casts(): array
    {
        return [
            'amount'      => 'decimal:2',
            'status'      => WithdrawalStatus::class,
            'reviewed_at' => 'datetime',
        ];
    }

    public function fundraiser(): BelongsTo
    {
        return $this->belongsTo(Fundraiser::class);
    }

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    public function reviewer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
