<?php

namespace App\Services;

use App\Enums\WithdrawalStatus;
use App\Models\Campaign;
use App\Models\Fundraiser;
use App\Models\User;
use App\Models\WithdrawalRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class WithdrawalService
{
    public function request(
        Fundraiser $fundraiser,
        Campaign $campaign,
        float $amount,
        array $bankData,
    ): WithdrawalRequest {
        if ($campaign->fundraiser_id !== $fundraiser->id) {
            throw ValidationException::withMessages([
                'campaign_id' => 'Program donasi bukan milik Anda.',
            ]);
        }

        if ($amount > $campaign->availableBalance()) {
            throw ValidationException::withMessages([
                'amount' => 'Saldo program tidak mencukupi. Tersedia: Rp' . number_format($campaign->availableBalance(), 0, ',', '.'),
            ]);
        }

        return WithdrawalRequest::create([
            'fundraiser_id'       => $fundraiser->id,
            'campaign_id'         => $campaign->id,
            'amount'              => $amount,
            'bank_name'           => $bankData['bank_name'],
            'bank_account_number' => $bankData['bank_account_number'],
            'bank_account_name'   => $bankData['bank_account_name'],
            'status'              => WithdrawalStatus::Pending,
        ]);
    }

    public function approve(WithdrawalRequest $request, User $admin, ?string $notes = null): WithdrawalRequest
    {
        return DB::transaction(function () use ($request, $admin, $notes) {
            $request = WithdrawalRequest::where('id', $request->id)
                ->lockForUpdate()
                ->firstOrFail();

            if ($request->status !== WithdrawalStatus::Pending) {
                throw ValidationException::withMessages([
                    'status' => 'Permintaan penarikan sudah diproses.',
                ]);
            }

            $campaign = Campaign::where('id', $request->campaign_id)->lockForUpdate()->firstOrFail();

            if ($request->amount > $campaign->availableBalance()) {
                throw ValidationException::withMessages([
                    'amount' => 'Saldo program tidak mencukupi.',
                ]);
            }

            $campaign->increment('withdrawn_amount', $request->amount);

            $wallet = $request->fundraiser->wallet;
            if ($wallet) {
                $wallet->decrement('balance', $request->amount);
            }

            $request->update([
                'status'      => WithdrawalStatus::Approved,
                'admin_notes' => $notes,
                'reviewed_by' => $admin->id,
                'reviewed_at' => now(),
            ]);

            return $request->fresh();
        });
    }

    public function reject(WithdrawalRequest $request, User $admin, string $notes): WithdrawalRequest
    {
        if ($request->status !== WithdrawalStatus::Pending) {
            throw ValidationException::withMessages([
                'status' => 'Permintaan penarikan sudah diproses.',
            ]);
        }

        $request->update([
            'status'      => WithdrawalStatus::Rejected,
            'admin_notes' => $notes,
            'reviewed_by' => $admin->id,
            'reviewed_at' => now(),
        ]);

        return $request->fresh();
    }
}
