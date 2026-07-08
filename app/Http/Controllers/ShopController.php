<?php

namespace App\Http\Controllers;

use App\Http\Requests\Shop\StoreShopRequest;
use App\Models\Shop;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    // Any normal user can open exactly one shop to start selling.
    public function store(StoreShopRequest $request)
    {
        $user = $request->user();

        if ($user->shop()->exists()) {
            return response()->json(['message' => 'Anda sudah memiliki toko.'], 422);
        }

        $shop = $user->shop()->create($request->validated());

        return response()->json(['shop' => $shop], 201);
    }

    public function show(Shop $shop)
    {
        // Eager load products + count of reviews per product in one round trip.
        $shop->load(['products' => function ($q) {
            $q->withCount('reviews');
        }]);

        return response()->json(['shop' => $shop]);
    }

    public function update(StoreShopRequest $request, Shop $shop)
    {
        if ($shop->user_id !== $request->user()->id) {
            abort(403, 'Anda bukan pemilik toko ini.');
        }

        $shop->update($request->validated());

        return response()->json(['shop' => $shop]);
    }
}
