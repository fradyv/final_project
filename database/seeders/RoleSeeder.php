<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['admin', 'user', 'fundraiser'] as $name) {
            Role::updateOrCreate(['name' => $name]);
        }
    }
}
