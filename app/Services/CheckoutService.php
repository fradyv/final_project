<?php

namespace App\Services;

use App\Enums\PaymentStatus;
use App\Models\Campaign;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CheckoutService
{
    /**
     * Process checkout: products + optional extra donation go directly to campaign.
     * Minimum total = sum of product prices (0 if donation-only with no products).
     */
    public function checkout(
        User $user,
        int $campaignId,
        array $productIds,
        float $totalAmount,
        ?int $paymentMethodId = null,
        ?string $bankName = null,
    ): Order {
        $subtotal = 0.0;
        $products = collect();

        return DB::transaction(function () use (
            $user, $campaignId, $productIds, $totalAmount,
            $paymentMethodId, $bankName
        ) {
            $campaign = Campaign::where('id', $campaignId)
                ->where('status', 'active')
                ->lockForUpdate()
                ->firstOrFail();

            $products = collect();

            if (! empty($productIds)) {
                $products = Product::whereIn('id', $productIds)
                    ->where('campaign_id', $campaignId)
                    ->where('stock', '>', 0)
                    ->lockForUpdate()
                    ->get();

                if ($products->count() !== count(array_unique($productIds))) {
                    throw ValidationException::withMessages([
                        'product_ids' => 'Semua produk harus aktif, tersedia, dan dari program donasi yang sama.',
                    ]);
                }

                foreach ($products as $product) {
                    if ($product->shop->user_id === $user->id) {
                        throw ValidationException::withMessages([
                            'product_ids' => 'Anda tidak dapat membeli produk sendiri.',
                        ]);
                    }
                }
            }

            $subtotal = (float) $products->sum('price');

            if ($subtotal > 0 && $totalAmount < $subtotal) {
                throw ValidationException::withMessages([
                    'total_amount' => 'Minimum pembayaran Rp' . number_format($subtotal, 0, ',', '.') . ' (total harga produk).',
                ]);
            }

            if ($subtotal === 0.0 && $totalAmount < 10000) {
                throw ValidationException::withMessages([
                    'total_amount' => 'Minimum donasi Rp10.000.',
                ]);
            }

            $additionalDonation = $totalAmount - $subtotal;

            foreach ($products as $product) {
                $product->decrement('stock');
            }

            $order = Order::create([
                'user_id'               => $user->id,
                'campaign_id'           => $campaign->id,
                'subtotal_products'     => $subtotal,
                'additional_donation'   => $additionalDonation,
                'total_amount'          => $totalAmount,
                'payment_method_id'     => $paymentMethodId,
                'bank_name'             => $bankName,
                'payment_status'        => PaymentStatus::Paid,
                'is_anonymous'          => $user->donate_anonymously,
                'paid_at'               => now(),
            ]);

            foreach ($products as $product) {
                $order->items()->create([
                    'product_id' => $product->id,
                    'unit_price' => $product->price,
                ]);
            }

            $campaign->increment('current_amount', $totalAmount);

            $fundraiser = $campaign->fundraiser;
            if ($fundraiser && $fundraiser->wallet) {
                $fundraiser->wallet->increment('balance', $totalAmount);
            }

            CartItem::where('user_id', $user->id)
                ->whereIn('product_id', $products->pluck('id'))
                ->delete();

            return $order->load(['items.product', 'campaign']);
        });
    }

    public function relatedProducts(int $campaignId, array $excludeIds = []): Collection
    {
        return Product::where('campaign_id', $campaignId)
            ->where('stock', '>', 0)
            ->when(! empty($excludeIds), fn ($q) => $q->whereNotIn('id', $excludeIds))
            ->with('shop:id,name')
            ->get();
    }
}
