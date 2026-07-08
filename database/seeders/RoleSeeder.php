<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
<<<<<<< HEAD
        foreach (['admin', 'user', 'fundraiser'] as $name) {
            Role::updateOrCreate(['name' => $name]);
        }
=======
        collect(['admin', 'penggalang', 'user'])->each(
            fn ($name) => Role::firstOrCreate(['name' => $name])
        );
>>>>>>> master
    }
}
