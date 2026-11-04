<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StorePermissionRequest;
use App\Http\Requests\Admin\StoreRoleRequest;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdatePermissionRequest;
use App\Http\Requests\Admin\UpdateRoleRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RbacController extends Controller
{
    /**
     * Store a newly created role with its permissions.
     */
    public function storeRole(StoreRoleRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $slug = ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['name']);

        $role = Role::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'] ?? null,
            'badge' => 'bg-blue-100 text-blue-800 border-blue-200',
            'is_active' => ($validated['status'] ?? 'published') === 'published',
        ]);

        if (isset($validated['permissions'])) {
            $role->permissions()->sync($validated['permissions']);
        }

        return redirect()->route('admin.crud.sample', ['section' => 'roles'])->with('success', "Peran '{$role->name}' berhasil ditambahkan ke database.");
    }

    /**
     * Update the specified role and its permissions.
     */
    public function updateRole(UpdateRoleRequest $request, Role $role): RedirectResponse
    {
        $validated = $request->validated();

        $slug = ! empty($validated['slug']) ? Str::slug($validated['slug']) : $role->slug;

        // Prevent changing superadmin slug
        if ($role->slug === User::ROLE_SUPERADMIN) {
            $slug = User::ROLE_SUPERADMIN;
        }

        $role->update([
            'name' => $validated['name'],
            'slug' => $slug,
            'description' => $validated['description'] ?? null,
            'is_active' => ($validated['status'] ?? 'published') === 'published',
        ]);

        if (isset($validated['permissions'])) {
            $role->permissions()->sync($validated['permissions']);
        }

        return redirect()->route('admin.crud.sample', ['section' => 'roles'])->with('success', "Peran '{$role->name}' berhasil diperbarui di database.");
    }

    /**
     * Delete the specified role.
     */
    public function destroyRole(Role $role): RedirectResponse
    {
        if ($role->slug === User::ROLE_SUPERADMIN) {
            return redirect()->route('admin.crud.sample', ['section' => 'roles'])->with('error', 'Peran Super Administrator adalah peran sistem utama dan tidak dapat dihapus.');
        }

        $roleName = $role->name;
        $role->delete();

        return redirect()->route('admin.crud.sample', ['section' => 'roles'])->with('success', "Peran '{$roleName}' berhasil dihapus dari database.");
    }

    /**
     * Store a newly created permission.
     */
    public function storePermission(StorePermissionRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $slug = ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['name']);

        $permission = Permission::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'module' => $validated['module'],
            'description' => $validated['description'] ?? null,
            'is_active' => ($validated['status'] ?? 'published') === 'published',
        ]);

        return redirect()->route('admin.crud.sample', ['section' => 'permissions'])->with('success', "Hak akses '{$permission->name}' berhasil ditambahkan ke database.");
    }

    /**
     * Update the specified permission.
     */
    public function updatePermission(UpdatePermissionRequest $request, Permission $permission): RedirectResponse
    {
        $validated = $request->validated();

        $slug = ! empty($validated['slug']) ? Str::slug($validated['slug']) : $permission->slug;

        $permission->update([
            'name' => $validated['name'],
            'slug' => $slug,
            'module' => $validated['module'],
            'description' => $validated['description'] ?? null,
            'is_active' => ($validated['status'] ?? 'published') === 'published',
        ]);

        return redirect()->route('admin.crud.sample', ['section' => 'permissions'])->with('success', "Hak akses '{$permission->name}' berhasil diperbarui di database.");
    }

    /**
     * Delete the specified permission.
     */
    public function destroyPermission(Permission $permission): RedirectResponse
    {
        $name = $permission->name;
        $permission->delete();

        return redirect()->route('admin.crud.sample', ['section' => 'permissions'])->with('success', "Hak akses '{$name}' berhasil dihapus dari database.");
    }

    /**
     * Store a newly created user with role assignment.
     */
    public function storeUser(StoreUserRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $role = Role::findOrFail($validated['role_id']);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $role->slug,
            'role_id' => $role->id,
            'email_verified_at' => now(),
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('admin.crud.sample', ['section' => 'users'])->with('success', "Pengguna '{$user->name}' berhasil didaftarkan ke database.");
    }

    /**
     * Update the specified user and their role assignment.
     */
    public function updateUser(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();

        $role = Role::findOrFail($validated['role_id']);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $role->slug,
            'role_id' => $role->id,
        ];

        if (! empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()->route('admin.crud.sample', ['section' => 'users'])->with('success', "Data pengguna '{$user->name}' berhasil diperbarui di database.");
    }

    /**
     * Delete the specified user.
     */
    public function destroyUser(User $user): RedirectResponse
    {
        if (auth()->id() === $user->id) {
            return redirect()->route('admin.crud.sample', ['section' => 'users'])->with('error', 'Anda tidak dapat menghapus akun Anda sendiri yang sedang aktif.');
        }

        $name = $user->name;
        $user->delete();

        return redirect()->route('admin.crud.sample', ['section' => 'users'])->with('success', "Akun pengguna '{$name}' berhasil dihapus dari database.");
    }
}
