<?php

namespace Database\Factories;

use App\Models\Fundraiser;
use Illuminate\Database\Eloquent\Factories\Factory;

class WalletFactory extends Factory
{
    protected $model = \App\Models\Wallet::class;

    public function definition(): array
    {
        return [
            'fundraiser_id' => Fundraiser::factory()->approved(),
            'balance'         => 0,
        ];
    }
}
