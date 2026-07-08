<?php

namespace Database\Factories;

use App\Enums\TransactionStatus;
use App\Models\Campaign;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DonationFactory extends Factory
{
    protected $model = \App\Models\Donation::class;

    public function definition(): array
    {
        return [
            'donor_id'  => User::factory(),
            'campaign_id' => Campaign::factory(),
            'amount'      => fake()->randomFloat(2, 10000, 1000000),
            'status'      => TransactionStatus::Success,
        ];
    }
}
