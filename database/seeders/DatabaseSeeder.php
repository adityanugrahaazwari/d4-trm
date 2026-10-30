<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@politala.ac.id'],
            [
                'name' => 'Administrator TRM',
                'role' => User::ROLE_SUPERADMIN,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ]
        );
    }
}
