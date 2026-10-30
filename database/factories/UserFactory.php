<?php

namespace Database\Factories;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Database\Seeders\RbacSeeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'role' => User::ROLE_ADMIN,
            'role_id' => null,
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Ensure RBAC roles and permissions exist in database.
     */
    protected function ensureRbacSeeded(): void
    {
        if (Permission::count() === 0) {
            (new RbacSeeder)->run();
        }
    }

    /**
     * Indicate that the user is a superadmin.
     */
    public function superadmin(): static
    {
        return $this->state(function (array $attributes) {
            $this->ensureRbacSeeded();

            $role = Role::firstOrCreate(
                ['slug' => User::ROLE_SUPERADMIN],
                ['name' => 'Super Administrator', 'badge' => 'bg-purple-100 text-purple-800 border-purple-200']
            );

            return [
                'role' => User::ROLE_SUPERADMIN,
                'role_id' => $role->id,
            ];
        });
    }

    /**
     * Indicate that the user is an academic administrator.
     */
    public function adminAkademik(): static
    {
        return $this->state(function (array $attributes) {
            $this->ensureRbacSeeded();

            $role = Role::firstOrCreate(
                ['slug' => User::ROLE_ADMIN_AKADEMIK],
                ['name' => 'Administrator Akademik', 'badge' => 'bg-blue-100 text-blue-800 border-blue-200']
            );

            return [
                'role' => User::ROLE_ADMIN_AKADEMIK,
                'role_id' => $role->id,
            ];
        });
    }

    /**
     * Indicate that the user is a content administrator.
     */
    public function adminKonten(): static
    {
        return $this->state(function (array $attributes) {
            $this->ensureRbacSeeded();

            $role = Role::firstOrCreate(
                ['slug' => User::ROLE_ADMIN_KONTEN],
                ['name' => 'Administrator Konten & Media', 'badge' => 'bg-emerald-100 text-emerald-800 border-emerald-200']
            );

            return [
                'role' => User::ROLE_ADMIN_KONTEN,
                'role_id' => $role->id,
            ];
        });
    }

    /**
     * Indicate that the user is a laboratory operator.
     */
    public function operatorLab(): static
    {
        return $this->state(function (array $attributes) {
            $this->ensureRbacSeeded();

            $role = Role::firstOrCreate(
                ['slug' => User::ROLE_OPERATOR_LAB],
                ['name' => 'Operator Lab & Fasilitas', 'badge' => 'bg-amber-100 text-amber-800 border-amber-200']
            );

            return [
                'role' => User::ROLE_OPERATOR_LAB,
                'role_id' => $role->id,
            ];
        });
    }

    /**
     * Indicate that the user is an editor.
     */
    public function editor(): static
    {
        return $this->state(function (array $attributes) {
            $this->ensureRbacSeeded();

            $role = Role::firstOrCreate(
                ['slug' => User::ROLE_EDITOR],
                ['name' => 'Editor Publikasi', 'badge' => 'bg-slate-100 text-slate-800 border-slate-200']
            );

            return [
                'role' => User::ROLE_EDITOR,
                'role_id' => $role->id,
            ];
        });
    }
}
