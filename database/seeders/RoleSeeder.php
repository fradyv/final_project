<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        collect(['admin', 'penggalang', 'user'])->each(
            fn ($name) => Role::firstOrCreate(['name' => $name])
        );
    }
}
