<?php

namespace Database\Factories;

use App\Enums\TransactionStatus;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    protected $model = \App\Models\Transaction::class;

    public function definition(): array
    {
        return [
            'buyer_id'     => User::factory(),
            'product_id'   => Product::factory(),
            'amount'       => fake()->randomFloat(2, 10000, 500000),
            'bank_name'    => fake()->randomElement(['BCA', 'BRI', 'BNI', 'Mandiri']),
            'payment_time' => fake()->dateTimeBetween('-3 months', 'now'),
            'status'       => TransactionStatus::Success,
        ];
    }
}
