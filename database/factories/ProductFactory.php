<?php

namespace Database\Factories;

use App\Models\Campaign;
use App\Models\Shop;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = \App\Models\Product::class;

    public function definition(): array
    {
        return [
            'shop_id'         => Shop::factory(),
            'campaign_id'     => Campaign::factory(),
            'title'           => fake()->words(4, true),
            'description'     => fake()->paragraph(),
            'price'           => fake()->randomFloat(2, 10000, 500000),
            'stock'           => fake()->numberBetween(1, 100),
            'product_preview' => 'products/previews/fake_preview.jpg',
            'category'        => fake()->randomElement(['ebook', 'template', 'ilustrasi', 'musik', 'source_code']),
            'file_url'        => 'products/files/fake_file.zip',
        ];
    }
}
