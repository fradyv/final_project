<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Http\Requests\Campaign\StoreCampaignRequest;
use App\Http\Requests\Campaign\UpdateCampaignRequest;
use App\Http\Requests\ProductReview\StoreProductReviewRequest;
use App\Models\Campaign;
use App\Models\ProductReview;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index(Request $request)
    {
        $trendingCampaigns = Campaign::where('status', 'active')
            ->with(['fundraiser:id,user_id', 'fundraiser.user:id,name,display_name'])
            ->withCount(['orders', 'products'])
            ->orderByDesc('current_amount')
            ->take(4)
            ->get();

        $newCampaigns = Campaign::where('status', 'active')
            ->with(['fundraiser:id,user_id', 'fundraiser.user:id,name,display_name'])
            ->withCount(['orders', 'products'])
            ->latest('created_at')
            ->take(4)
            ->get();

        $campaigns = Campaign::where('status', 'active')
            ->with(['fundraiser:id,user_id,bank_name', 'fundraiser.user:id,name,display_name'])
            ->withCount(['orders', 'products'])
            ->latest('created_at')
            ->paginate(15);

        return view('dashboard.program-donasi', compact('trendingCampaigns', 'newCampaigns', 'campaigns'));
    }

    public function store(StoreCampaignRequest $request)
    {
        $fundraiser = $request->user()->fundraiser;

        $campaign = $fundraiser->campaigns()->create([
            ...$request->validated(),
            'current_amount'   => 0,
            'withdrawn_amount' => 0,
            'status'           => 'active',
        ]);

        return response()->json(['campaign' => $campaign], 201);
    }

    public function show(Campaign $campaign)
    {
        $campaign->load(['fundraiser.user:id,name,display_name', 'products.shop:id,name'])
            ->loadCount(['orders', 'products']);

        return response()->json(['campaign' => $campaign]);
    }

    public function products(Campaign $campaign)
    {
        $products = $campaign->products()
            ->with('shop:id,name,user_id')
            ->where('stock', '>', 0)
            ->get();

        return response()->json(['products' => $products]);
    }

    public function update(UpdateCampaignRequest $request, Campaign $campaign)
    {
        if ($campaign->fundraiser->user_id !== $request->user()->id) {
            abort(403, 'Anda bukan pemilik campaign ini.');
        }

        $campaign->update($request->validated());

        return response()->json(['campaign' => $campaign]);
    }
}
