<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
<<<<<<< HEAD
use App\Models\Wallet;
=======
use App\Models\UserNotificationPreference;
use App\Models\UserPrivacySetting;
>>>>>>> master
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
<<<<<<< HEAD
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
=======
        $adminRole = Role::where('name', 'admin')->firstOrFail();
        $userRole  = Role::where('name', 'user')->firstOrFail();

        $admin = User::factory()->create([
            'name'         => 'Admin Charity',
            'display_name' => 'Admin Charity',
            'email'        => 'admin@charity.test',
            'password'     => 'password',
        ]);
        $admin->roles()->attach($adminRole->id);
        UserNotificationPreference::create(['user_id' => $admin->id]);
        UserPrivacySetting::create(['user_id' => $admin->id]);

        $demoUser = User::factory()->create([
            'name'         => 'Demo User',
            'display_name' => 'Demo User',
            'email'        => 'user@charity.test',
            'password'     => 'password',
        ]);
        $demoUser->roles()->attach($userRole->id);
        UserNotificationPreference::create(['user_id' => $demoUser->id]);
        UserPrivacySetting::create(['user_id' => $demoUser->id]);

        User::factory()
            ->count(20)
            ->create()
            ->each(function (User $user) use ($userRole) {
                $user->update(['display_name' => $user->name]);
                $user->roles()->attach($userRole->id);
                UserNotificationPreference::create(['user_id' => $user->id]);
                UserPrivacySetting::create(['user_id' => $user->id]);
            });
>>>>>>> master
    }
}
