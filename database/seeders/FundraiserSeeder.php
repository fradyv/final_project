<?php

namespace Database\Seeders;

use App\Enums\FundraiserStatus;
use App\Models\Fundraiser;
use App\Models\Role;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class FundraiserSeeder extends Seeder
{
    public function run(): void
    {
        $penggalangRole = Role::where('name', 'penggalang')->firstOrFail();

        $candidates = User::whereHas('roles', fn ($q) => $q->where('name', 'user'))
            ->whereDoesntHave('fundraiser')
            ->inRandomOrder()
            ->take(6)
            ->get();

        foreach ($candidates as $index => $user) {
            $status = match (true) {
                $index < 4    => FundraiserStatus::Approved,
                $index === 4  => FundraiserStatus::Pending,
                default       => FundraiserStatus::Rejected,
            };

            $fundraiser = Fundraiser::factory()->create([
                'user_id' => $user->id,
                'status'  => $status,
            ]);

            if ($status === FundraiserStatus::Approved) {
                $user->roles()->attach($penggalangRole->id);
                Wallet::create(['fundraiser_id' => $fundraiser->id, 'balance' => 0]);
            }
        }
    }
}
