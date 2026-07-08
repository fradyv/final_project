<?php

namespace Database\Factories;

use App\Enums\PaymentStatus;
use App\Models\Campaign;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = \App\Models\Order::class;

    public function definition(): array
    {
        $subtotal = fake()->randomFloat(2, 10000, 500000);
        $extra = fake()->randomFloat(2, 0, 50000);

        return [
            'user_id'             => User::factory(),
            'campaign_id'         => Campaign::factory(),
            'subtotal_products'   => $subtotal,
            'additional_donation' => $extra,
            'total_amount'        => $subtotal + $extra,
            'payment_status'      => PaymentStatus::Paid,
            'is_anonymous'        => false,
            'paid_at'             => now(),
        ];
    }
}
