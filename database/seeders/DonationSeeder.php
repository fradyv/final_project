<?php

namespace Database\Seeders;

use App\Enums\CampaignStatus;
use App\Enums\TransactionStatus;
use App\Models\Campaign;
use App\Models\Donation;
use App\Models\User;
use Illuminate\Database\Seeder;

class DonationSeeder extends Seeder
{
    public function run(): void
    {
        $campaigns = Campaign::where('status', CampaignStatus::Active)->get();

        if ($campaigns->isEmpty()) {
            return;
        }

        // Any user who earned something from selling products may donate part
        // of it - this is the core "donate without spending real money" concept.
        User::whereHas('wallet', fn ($q) => $q->where('balance', '>', 0))
            ->with('wallet')
            ->get()
            ->each(function (User $user) use ($campaigns) {
                $wallet = $user->wallet;
                $amount = round($wallet->balance * (rand(20, 60) / 100), 2);

                if ($amount < 1) {
                    return;
                }

                $campaign = $campaigns->random();

                Donation::create([
                    'donor_id'  => $user->id,
                    'campaign_id' => $campaign->id,
                    'amount'      => $amount,
                    'status'      => TransactionStatus::Success,
                ]);

                $wallet->decrement('balance', $amount);
         
            });
    }
}
