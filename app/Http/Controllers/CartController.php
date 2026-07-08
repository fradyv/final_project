<?php

namespace App\Http\Controllers;

use App\Http\Requests\Cart\StoreCartItemRequest;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $items = $request->user()->cartItems()
            ->with(['product.shop', 'product.campaign'])
            ->get();

        $campaignId = $items->first()?->product?->campaign_id;
        $subtotal = $items->sum(fn ($item) => $item->product->price);

        if ($request->expectsJson()) {
            return response()->json(compact('items', 'campaignId', 'subtotal'));
        }

        return view('cart.index', compact('items', 'campaignId', 'subtotal'));
    }

    public function store(StoreCartItemRequest $request)
    {
        $user = $request->user();
        $product = Product::with('shop')->findOrFail($request->validated('product_id'));

        if ($product->shop->user_id === $user->id) {
            throw ValidationException::withMessages([
                'product_id' => 'Anda tidak dapat menambahkan produk sendiri ke keranjang.',
            ]);
        }

        if ($product->stock < 1) {
            throw ValidationException::withMessages([
                'product_id' => 'Stok produk habis.',
            ]);
        }

        $existing = $user->cartItems()->with('product')->get();
        if ($existing->isNotEmpty()) {
            $existingCampaignId = $existing->first()->product->campaign_id;
            if ($existingCampaignId !== $product->campaign_id) {
                throw ValidationException::withMessages([
                    'product_id' => 'Keranjang hanya boleh berisi produk dari program donasi yang sama.',
                ]);
            }
        }

        CartItem::firstOrCreate([
            'user_id'    => $user->id,
            'product_id' => $product->id,
        ]);

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Produk ditambahkan ke keranjang.'], 201);
        }

        return redirect()->route('cart.index')->with('success', 'Produk ditambahkan ke keranjang.');
    }

    public function destroy(Request $request, Product $product)
    {
        $request->user()->cartItems()->where('product_id', $product->id)->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Produk dihapus dari keranjang.']);
        }

        return redirect()->route('cart.index')->with('success', 'Produk dihapus dari keranjang.');
    }

    public function clear(Request $request)
    {
        $request->user()->cartItems()->delete();

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Keranjang dikosongkan.']);
        }

        return redirect()->route('cart.index')->with('success', 'Keranjang dikosongkan.');
    }
}
