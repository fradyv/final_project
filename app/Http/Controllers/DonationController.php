<?php

namespace App\Http\Controllers;

use App\Http\Requests\Donation\StoreDonationRequest;
use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class DonationController extends Controller
{
    /**
     * A donation is funded from the donor's wallet balance (product sale
     * earnings), never real cash directly - matches the product concept.
     * Wrapped in a DB transaction with a locked row read to avoid a race
     * condition where two concurrent donations could overdraw the wallet.
     */
    public function store(StoreDonationRequest $request)
    {
        $data = $request->validated();
        $user = $request->user();

        $donation = DB::transaction(function () use ($data, $user) {
            $wallet = $user->wallet()->lockForUpdate()->first();

            if (! $wallet || $wallet->balance < $data['amount']) {
                throw ValidationException::withMessages([
                    'amount' => 'Saldo wallet tidak mencukupi.',
                ]);
            }

            $campaign = Campaign::where('id', $data['campaign_id'])
                ->where('status', 'active')
                ->lockForUpdate()
                ->firstOrFail();

            $wallet->decrement('balance', $data['amount']);
            $campaign->increment('current_amount', $data['amount']);

            return Donation::create([
                'donor_id'    => $user->id,
                'campaign_id' => $campaign->id,
                'amount'      => $data['amount'],
                'status'      => 'success',
            ]);
        });

        return response()->json(['donation' => $donation], 201);
    }

    public function index(Request $request)
    {
        $donations = $request->user()
            ->donations()
            ->with('campaign:id,title')
            ->latest('created_at')
            ->paginate(15);

        return response()->json($donations);
    }
}
