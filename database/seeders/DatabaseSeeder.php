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
        $users = [
            [
                'name' => 'Administrator Utama TRM',
                'email' => 'admin@politala.ac.id',
                'role' => User::ROLE_SUPERADMIN,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Koordinator Prodi D-IV TRM',
                'email' => 'kaprodi.trm@politala.ac.id',
                'role' => User::ROLE_SUPERADMIN,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Staf Administrasi Akademik',
                'email' => 'akademik.trm@politala.ac.id',
                'role' => 'admin-akademik',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Humas & Pengelola Konten Media',
                'email' => 'media.trm@politala.ac.id',
                'role' => 'admin-konten',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Pranata Laboratorium Komputer & Studio (PLP)',
                'email' => 'lab.trm@politala.ac.id',
                'role' => 'operator-lab',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $userData) {
            User::updateOrCreate(
                ['email' => $userData['email']],
                $userData
            );
        }
    }
}
