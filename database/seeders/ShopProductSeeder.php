<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Product;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Database\Seeder;

class ShopProductSeeder extends Seeder
{
    public function run(): void
    {
        $activeCampaigns = Campaign::where('status', 'active')->pluck('id');

        if ($activeCampaigns->isEmpty()) {
            return;
        }

        User::whereHas('roles', fn ($q) => $q->where('name', 'user'))
            ->inRandomOrder()
            ->take(10)
            ->get()
            ->each(function (User $user) use ($activeCampaigns) {
                $shop = Shop::factory()->create(['user_id' => $user->id]);

                Product::factory()
                    ->count(rand(3, 6))
                    ->create([
                        'shop_id'     => $shop->id,
                        'campaign_id' => $activeCampaigns->random(),
                    ]);
            });
    }
}
