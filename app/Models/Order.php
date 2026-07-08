<?php

namespace App\Models;

use App\Enums\PaymentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'campaign_id',
        'subtotal_products',
        'additional_donation',
        'total_amount',
        'payment_method_id',
        'bank_name',
        'payment_status',
        'is_anonymous',
        'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'subtotal_products'  => 'decimal:2',
            'additional_donation' => 'decimal:2',
            'total_amount'       => 'decimal:2',
            'payment_status'     => PaymentStatus::class,
            'is_anonymous'       => 'boolean',
            'paid_at'            => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function donorDisplayName(): string
    {
        if ($this->is_anonymous) {
            return 'Anonim';
        }

        return $this->user?->display_name ?? $this->user?->name ?? 'Pengguna';
    }
}
