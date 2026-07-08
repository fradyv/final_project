<?php

namespace Database\Seeders;

use App\Enums\FundraiserStatus;
use App\Models\Campaign;
use App\Models\Fundraiser;
use Illuminate\Database\Seeder;

class CampaignSeeder extends Seeder
{
    public function run(): void
    {
        Fundraiser::where('status', FundraiserStatus::Approved)
            ->get()
            ->each(function (Fundraiser $fundraiser) {
                Campaign::factory()
                    ->count(rand(1, 3))
                    ->create(['fundraiser_id' => $fundraiser->id]);
            });
    }
}
