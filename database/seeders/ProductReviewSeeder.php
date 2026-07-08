<?php

namespace Database\Seeders;

use App\Enums\PaymentStatus;
use App\Models\Order;
use App\Models\ProductReview;
use Illuminate\Database\Seeder;

class ProductReviewSeeder extends Seeder
{
    public function run(): void
    {
        $orders = Order::where('payment_status', PaymentStatus::Paid)
            ->with('items')
            ->get();

        $sampleSize = (int) ceil($orders->count() * 0.5);

        $orders->shuffle()->take($sampleSize)->each(function (Order $order) {
            foreach ($order->items as $item) {
                ProductReview::factory()->create([
                    'product_id' => $item->product_id,
                    'user_id'    => $order->user_id,
                ]);
            }
        });
    }
}
