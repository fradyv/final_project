<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            FundraiserSeeder::class,
            CampaignSeeder::class,
            ShopProductSeeder::class,
            OrderSeeder::class,
            ProductReviewSeeder::class,
        ]);
    }
}
