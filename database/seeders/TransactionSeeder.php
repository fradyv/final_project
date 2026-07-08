<?php

namespace Database\Seeders;

use App\Enums\TransactionStatus;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        $buyers   = User::whereHas('roles', fn ($q) => $q->where('name', 'user'))->get();
        $products = Product::with('shop.user.wallet')->where('stock', '>', 0)->get();

        foreach ($products as $product) {
            $purchaseCount = rand(0, 3);

            for ($i = 0; $i < $purchaseCount && $product->stock > 0; $i++) {
                $buyer = $buyers->reject(fn ($u) => $u->id === $product->shop->user_id)->random();

                Transaction::factory()->create([
                    'buyer_id'     => $buyer->id,
                    'product_id'   => $product->id,
                    'amount'       => $product->price,
                    'payment_time' => now(),
                    'status'       => TransactionStatus::Success,
                ]);

                $product->decrement('stock');

                // Seller earnings land straight in their wallet - this is the
                // platform's core rule: sale income can only be donated, not withdrawn.
                $product->shop->user->wallet->increment('balance', $product->price);
            }
        }
    }
}
