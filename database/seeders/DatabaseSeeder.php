<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
<<<<<<< HEAD
    /**
     * Seed the application's database.
     */
=======
>>>>>>> master
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
<<<<<<< HEAD
=======
            FundraiserSeeder::class,
            CampaignSeeder::class,
            ShopProductSeeder::class,
            OrderSeeder::class,
            ProductReviewSeeder::class,
>>>>>>> master
        ]);
    }
}
