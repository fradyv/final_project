<?php

namespace App\Http\Controllers;

use App\Enums\PaymentStatus;
use App\Models\Campaign;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user()->load(['roles', 'shop', 'fundraiser.wallet']);

        $totalDonasi = $user->orders()->where('payment_status', PaymentStatus::Paid)->sum('total_amount');

        $karyaTerjual = Order::where('payment_status', PaymentStatus::Paid)
            ->whereHas('items.product.shop', fn ($q) => $q->where('user_id', $user->id))
            ->count();

        $inisiasiProgram = $user->fundraiser
            ? $user->fundraiser->campaigns()->count()
            : 0;

        $saldoWallet = $user->fundraiser?->wallet?->balance ?? 0;

        $donations = $user->orders()
            ->with('campaign:id,title')
            ->where('payment_status', PaymentStatus::Paid)
            ->latest('created_at')
            ->take(5)
            ->get();

        $trendingCampaigns = Campaign::where('status', 'active')
            ->with(['fundraiser:id,user_id', 'fundraiser.user:id,name,display_name'])
            ->withCount('orders')
            ->orderByDesc('current_amount')
            ->take(4)
            ->get();

        return view('dashboard.dashboard-beranda', compact(
            'user',
            'totalDonasi',
            'karyaTerjual',
            'inisiasiProgram',
            'saldoWallet',
            'donations',
            'trendingCampaigns'
        ));
    }
}
