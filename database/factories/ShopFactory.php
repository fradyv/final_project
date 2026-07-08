<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShopFactory extends Factory
{
    protected $model = \App\Models\Shop::class;

    public function definition(): array
    {
        return [
            'user_id'     => User::factory(),
            'name'   => fake()->company() . ' Store',
            'description' => fake()->sentence(15),
        ];
    }
}
