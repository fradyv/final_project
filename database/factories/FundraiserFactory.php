<?php

namespace Database\Factories;

use App\Enums\FundraiserStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FundraiserFactory extends Factory
{
    protected $model = \App\Models\Fundraiser::class;

    public function definition(): array
    {
        return [
            'user_id'              => User::factory(),
            'ktp_number'           => fake()->unique()->numerify('################'),
            'ktp_photo'            => 'fundraisers/fake_ktp.jpg',
            'selfie_and_ktp_photo' => 'fundraisers/fake_selfie_ktp.jpg',
            'bank_name'            => fake()->randomElement(['BCA', 'BRI', 'BNI', 'Mandiri']),
            'bank_account_number'  => fake()->numerify('##########'),
            'bank_account_name'    => fake()->name(),
            'statement_letter'     => 'fundraisers/fake_statement.pdf',
            'other_documents'      => 'fundraisers/fake_supporting.pdf',
            'status'               => FundraiserStatus::Pending,
        ];
    }

    public function approved(): static
    {
        return $this->state(fn () => ['status' => FundraiserStatus::Approved]);
    }

    public function rejected(): static
    {
        return $this->state(fn () => ['status' => FundraiserStatus::Rejected]);
    }
}
