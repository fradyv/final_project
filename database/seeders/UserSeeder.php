<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            [
                'name' => 'Admin',
                'email' => 'admin@mail.com',
                'roles' => ['admin'],
            ],
            [
                'name' => 'Normal User',
                'email' => 'user@mail.com',
                'roles' => ['user'],
            ],
            [
                'name' => 'Fundraiser Demo',
                'email' => 'fundraiser@mail.com',
                'roles' => ['user', 'fundraiser'],
            ],
        ];

        foreach ($accounts as $account) {
            $user = User::updateOrCreate(
                ['email' => $account['email']],
                [
                    'name' => $account['name'],
                    'password' => 'password',
                    'email_verified_at' => now(),
                ]
            );

            $roleIds = Role::whereIn('name', $account['roles'])->pluck('id');
            $user->roles()->syncWithoutDetaching($roleIds);

            Wallet::updateOrCreate(
                ['user_id' => $user->id],
                ['balance' => 0]
            );
        }
    }
}
