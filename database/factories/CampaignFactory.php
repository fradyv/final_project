<?php

namespace Database\Factories;

use App\Enums\CampaignStatus;
use App\Models\Fundraiser;
use Illuminate\Database\Eloquent\Factories\Factory;

class CampaignFactory extends Factory
{
    protected $model = \App\Models\Campaign::class;

    public function definition(): array
    {
        $target = fake()->numberBetween(1000000, 100000000);

        return [
            'fundraiser_id'    => Fundraiser::factory()->approved(),
            'title'            => fake()->sentence(6),
            'description'      => fake()->paragraphs(3, true),
            'target_amount'    => $target,
            'current_amount'   => 0,
            'withdrawn_amount' => 0,
            'status'           => CampaignStatus::Active,
            'end_date'         => now()->addDays(fake()->numberBetween(30, 180)),
        ];
    }

    public function completed(): static
    {
        return $this->state(fn (array $attrs) => [
            'status'         => CampaignStatus::Completed,
            'current_amount' => $attrs['target_amount'] ?? fake()->numberBetween(1000000, 100000000),
        ]);
    }

    public function draft(): static
    {
        return $this->state(fn () => ['status' => CampaignStatus::Draft]);
    }
}
