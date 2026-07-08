<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Product;
use App\Models\User;
use App\Services\CheckoutService;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    public function run(): void
    {
        $checkout = app(CheckoutService::class);
        $buyers = User::whereHas('roles', fn ($q) => $q->where('name', 'user'))->get();
        $products = Product::with('shop')->where('stock', '>', 0)->get();

        foreach ($products as $product) {
            if (rand(0, 1) === 0) {
                continue;
            }

            $buyer = $buyers->reject(fn ($u) => $u->id === $product->shop->user_id)->random();

            try {
                $extra = rand(0, 1) ? fake()->randomFloat(2, 5000, 50000) : 0;
                $checkout->checkout(
                    user: $buyer,
                    campaignId: $product->campaign_id,
                    productIds: [$product->id],
                    totalAmount: (float) $product->price + $extra,
                    bankName: fake()->randomElement(['BCA', 'BRI', 'BNI']),
                );
            } catch (\Throwable) {
                continue;
            }
        }

        // Donasi langsung tanpa produk
        Campaign::where('status', 'active')->take(3)->each(function (Campaign $campaign) use ($buyers, $checkout) {
            $buyer = $buyers->random();
            try {
                $checkout->checkout(
                    user: $buyer,
                    campaignId: $campaign->id,
                    productIds: [],
                    totalAmount: fake()->randomFloat(2, 10000, 100000),
                    bankName: 'BCA',
                );
            } catch (\Throwable) {
                // skip
            }
        });
    }
}
