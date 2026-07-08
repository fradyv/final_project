<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Http\Requests\ProductReview\StoreProductReviewRequest;
use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class ProductReviewController extends Controller
{
    public function store(StoreProductReviewRequest $request)
    {
        $data = $request->validated();
        $user = $request->user();

        $hasPurchased = $user->orders()
            ->where('payment_status', PaymentStatus::Paid)
            ->whereHas('items', fn ($q) => $q->where('product_id', $data['product_id']))
            ->exists();

        if (! $hasPurchased) {
            return response()->json(['message' => 'Anda hanya bisa mengulas produk yang sudah dibeli.'], 403);
        }

        if (ProductReview::where('product_id', $data['product_id'])->where('user_id', $user->id)->exists()) {
            return response()->json(['message' => 'Anda sudah mengulas produk ini.'], 422);
        }

        $review = ProductReview::create([
            'product_id' => $data['product_id'],
            'user_id'    => $user->id,
            'rating'     => $data['rating'],
            'comment'    => $data['comment'] ?? null,
        ]);

        return response()->json(['review' => $review], 201);
    }

    public function index(Product $product)
    {
        $reviews = $product->reviews()
            ->with('user:id,name,display_name')
            ->latest('created_at')
            ->paginate(15);

        return response()->json($reviews);
    }
}
