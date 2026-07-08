<?php

namespace App\Http\Controllers;

use App\Http\Requests\Checkout\StoreCheckoutRequest;
use App\Models\Campaign;
use App\Models\Product;
use App\Services\CheckoutService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct(private CheckoutService $checkoutService) {}

    public function show(Request $request)
    {
        $user = $request->user();
        $campaignId = (int) $request->query('campaign_id');
        $productIds = array_filter(array_map('intval', (array) $request->query('product_ids', [])));

        if (empty($productIds) && $user->cartItems()->exists()) {
            $cartProducts = $user->cartItems()->with('product')->get();
            $productIds = $cartProducts->pluck('product_id')->all();
            $campaignId = $campaignId ?: (int) $cartProducts->first()?->product?->campaign_id;
        }

        if (! $campaignId && count($productIds) === 1) {
            $campaignId = (int) Product::where('id', $productIds[0])->value('campaign_id');
        }

        $campaign = $campaignId ? Campaign::with('fundraiser.user:id,name')->findOrFail($campaignId) : null;
        $selectedProducts = Product::whereIn('id', $productIds)->with('shop:id,name')->get();
        $subtotal = (float) $selectedProducts->sum('price');
        $relatedProducts = $campaign
            ? $this->checkoutService->relatedProducts($campaign->id, $productIds)
            : collect();
        $paymentMethods = $user->paymentMethods;

        return view('checkout.show', compact(
            'campaign', 'selectedProducts', 'subtotal',
            'relatedProducts', 'paymentMethods', 'productIds'
        ));
    }

    public function store(StoreCheckoutRequest $request)
    {
        $data = $request->validated();
        $productIds = $data['product_ids'] ?? [];

        $order = $this->checkoutService->checkout(
            user: $request->user(),
            campaignId: $data['campaign_id'],
            productIds: $productIds,
            totalAmount: (float) $data['total_amount'],
            paymentMethodId: $data['payment_method_id'] ?? null,
            bankName: $data['bank_name'] ?? null,
        );

        if ($request->expectsJson()) {
            return response()->json(['order' => $order], 201);
        }

        return redirect()->route('orders.show', $order)->with('success', 'Pembayaran berhasil!');
    }
}
