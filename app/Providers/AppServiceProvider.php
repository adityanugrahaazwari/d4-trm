<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Super Administrator has unrestricted permissions across the entire application
        Gate::before(function (User $user, string $ability) {
            if ($user->isSuperAdmin()) {
                return true;
            }
        });

        // Granular Gates based on User role methods
        Gate::define('manage-rbac', fn (User $user) => $user->canManageRbac());
        Gate::define('manage-users', fn (User $user) => $user->canManageRbac());
        Gate::define('manage-roles', fn (User $user) => $user->canManageRbac());
        Gate::define('manage-permissions', fn (User $user) => $user->canManageRbac());
        Gate::define('manage-settings', fn (User $user) => $user->canManageSettings());
        Gate::define('manage-profile', fn (User $user) => $user->canManageProfile());
        Gate::define('manage-staff', fn (User $user) => $user->canManageStaff());
        Gate::define('manage-academic', fn (User $user) => $user->canManageAcademic());
        Gate::define('manage-news', fn (User $user) => $user->canManageNews());
        Gate::define('manage-gallery', fn (User $user) => $user->canManageGallery());
        Gate::define('manage-facilities', fn (User $user) => $user->canManageFacilities());
        Gate::define('manage-media', fn (User $user) => $user->canManageMedia());
        Gate::define('access-section', fn (User $user, string $section) => $user->canAccessSection($section));
    }
}
