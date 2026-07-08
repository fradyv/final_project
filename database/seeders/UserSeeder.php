<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\UserNotificationPreference;
use App\Models\UserPrivacySetting;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
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
    }
}
