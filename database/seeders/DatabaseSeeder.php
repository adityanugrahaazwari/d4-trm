<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $this->call(RbacSeeder::class);

        $superadminRole = Role::where('slug', 'superadmin')->first();
        $akademikRole = Role::where('slug', 'admin-akademik')->first();
        $kontenRole = Role::where('slug', 'admin-konten')->first();
        $operatorRole = Role::where('slug', 'operator-lab')->first();

        $users = [
            [
                'name' => 'Administrator Utama TRM',
                'email' => 'admin@politala.ac.id',
                'role' => User::ROLE_SUPERADMIN,
                'role_id' => $superadminRole?->id,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Koordinator Prodi D-IV TRM',
                'email' => 'kaprodi.trm@politala.ac.id',
                'role' => User::ROLE_SUPERADMIN,
                'role_id' => $superadminRole?->id,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Staf Administrasi Akademik',
                'email' => 'akademik.trm@politala.ac.id',
                'role' => 'admin-akademik',
                'role_id' => $akademikRole?->id,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Humas & Pengelola Konten Media',
                'email' => 'media.trm@politala.ac.id',
                'role' => 'admin-konten',
                'role_id' => $kontenRole?->id,
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Pranata Laboratorium Komputer & Studio (PLP)',
                'email' => 'lab.trm@politala.ac.id',
                'role' => 'operator-lab',
                'role_id' => $operatorRole?->id,
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
