<?php

namespace App\Http\Controllers;

use App\Http\Requests\DigitalProduct\StoreDigitalProductRequest;
use App\Http\Requests\DigitalProduct\UpdateDigitalProductRequest;
use App\Models\Campaign;
use App\Models\Product;
use Illuminate\Http\Request;

class DigitalProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->with(['shop:id,name', 'campaign:id,title'])
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->when($request->filled('category'), fn ($q) => $q->where('category', $request->string('category')))
            ->when($request->filled('search'), fn ($q) => $q->where('title', 'like', '%' . $request->string('search') . '%'))
            ->where('stock', '>', 0)
            ->paginate(15);

        $user = $request->user();
        $activeCampaigns = Campaign::where('status', 'active')->get(['id', 'title']);

        return view('dashboard.kindlyshop', compact('products', 'user', 'activeCampaigns'));
    }

    public function store(StoreDigitalProductRequest $request)
    {
        $shop = $request->user()->shop;
        $data = $request->validated();

        if ($request->hasFile('product_preview')) {
            $data['product_preview'] = $request->file('product_preview')->store('products/previews', 'private');
        }
        if ($request->hasFile('file_url')) {
            $data['file_url'] = $request->file('file_url')->store('products/files', 'private');
        }

        $product = $shop->products()->create($data);

        return response()->json(['product' => $product->load('campaign')], 201);
    }

    public function show(Product $product)
    {
        $product->load(['shop:id,name', 'campaign:id,title', 'reviews.user:id,display_name,name']);

        return response()->json(['product' => $product]);
    }

    public function update(UpdateDigitalProductRequest $request, Product $product)
    {
        if ($product->shop->user_id !== $request->user()->id) {
            abort(403, 'Anda bukan pemilik produk ini.');
        }

        $data = $request->validated();

        if ($request->hasFile('product_preview')) {
            $data['product_preview'] = $request->file('product_preview')->store('products/previews', 'private');
        }
        if ($request->hasFile('file_url')) {
            $data['file_url'] = $request->file('file_url')->store('products/files', 'private');
        }

        $product->update($data);

        return response()->json(['product' => $product]);
    }

    public function destroy(Request $request, Product $product)
    {
        if ($product->shop->user_id !== $request->user()->id) {
            abort(403, 'Anda bukan pemilik produk ini.');
        }

        $product->delete();

        return response()->json(['message' => 'Produk dihapus.']);
    }
}
