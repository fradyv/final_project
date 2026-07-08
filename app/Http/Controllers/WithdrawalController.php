<?php

namespace App\Http\Controllers;

use App\Http\Requests\Withdrawal\StoreWithdrawalRequest;
use App\Models\Campaign;
use App\Services\WithdrawalService;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function __construct(private WithdrawalService $withdrawalService) {}

    public function index(Request $request)
    {
        $fundraiser = $request->user()->fundraiser;
        $campaigns = $fundraiser?->campaigns()->get() ?? collect();
        $requests = $fundraiser?->withdrawalRequests()->with('campaign:id,title')->latest()->get() ?? collect();
        $wallet = $fundraiser?->wallet;

        return view('wallet.index', compact('campaigns', 'requests', 'wallet'));
    }

    public function store(StoreWithdrawalRequest $request)
    {
        $fundraiser = $request->user()->fundraiser;
        $campaign = Campaign::findOrFail($request->validated('campaign_id'));

        $withdrawal = $this->withdrawalService->request(
            $fundraiser,
            $campaign,
            (float) $request->validated('amount'),
            $request->safe()->only(['bank_name', 'bank_account_number', 'bank_account_name']),
        );

        if ($request->expectsJson()) {
            return response()->json(['withdrawal' => $withdrawal], 201);
        }

        return back()->with('success', 'Permintaan penarikan terkirim.');
    }
}
