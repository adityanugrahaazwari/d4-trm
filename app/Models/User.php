<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role', 'role_id'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Role definitions
     */
    public const ROLE_SUPERADMIN = 'superadmin';

    public const ROLE_ADMIN = 'admin';

    public const ROLE_ADMIN_AKADEMIK = 'admin-akademik';

    public const ROLE_ADMIN_KONTEN = 'admin-konten';

    public const ROLE_OPERATOR_LAB = 'operator-lab';

    public const ROLE_EDITOR = 'editor';

    /**
     * Permission mapping for each CRUD section.
     */
    public const SECTION_PERMISSIONS = [
        'users' => 'manage-users',
        'roles' => 'manage-users',
        'permissions' => 'manage-users',
        'identitas' => 'manage-settings',
        'homepage' => 'manage-settings',
        'kontak-sosmed' => 'manage-settings',
        'logo-favicon' => 'manage-settings',
        'sejarah' => 'manage-profile',
        'visi-misi' => 'manage-profile',
        'sambutan' => 'manage-profile',
        'struktur' => 'manage-profile',
        'dosen' => 'manage-staff',
        'tendik' => 'manage-staff',
        'kurikulum' => 'manage-academic',
        'mata-kuliah' => 'manage-academic',
        'kalender' => 'manage-academic',
        'cpl' => 'manage-academic',
        'profil-lulusan' => 'manage-academic',
        'berita' => 'manage-news',
        'kategori-berita' => 'manage-news',
        'pengumuman' => 'manage-news',
        'agenda' => 'manage-news',
        'fasilitas' => 'manage-facilities',
        'album-galeri' => 'manage-gallery',
        'foto-galeri' => 'manage-gallery',
        'media-list' => 'upload-media',
        'media-upload' => 'upload-media',
        'my-profile' => null,
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Role relationship (Dynamic Database RBAC).
     */
    public function roleRelation(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * Check if user is a superadmin.
     */
    public function isSuperAdmin(): bool
    {
        if ($this->role === self::ROLE_SUPERADMIN) {
            return true;
        }

        return $this->roleRelation?->slug === self::ROLE_SUPERADMIN;
    }

    /**
     * Check if user has administrative privileges.
     */
    public function isAdmin(): bool
    {
        return $this->isSuperAdmin() || in_array($this->role, [self::ROLE_SUPERADMIN, self::ROLE_ADMIN], true);
    }

    /**
     * Get human-readable role label.
     */
    public function getRoleLabelAttribute(): string
    {
        if ($this->roleRelation) {
            return $this->roleRelation->name;
        }

        return match ($this->role) {
            self::ROLE_SUPERADMIN => 'Super Administrator',
            self::ROLE_ADMIN_AKADEMIK => 'Administrator Akademik',
            self::ROLE_ADMIN_KONTEN => 'Administrator Konten & Media',
            self::ROLE_OPERATOR_LAB => 'Operator Lab & Fasilitas',
            self::ROLE_EDITOR => 'Editor Publikasi',
            default => ucfirst(str_replace('-', ' ', (string) $this->role)),
        };
    }

    /**
     * Dynamic check if user has a specific permission via database relationship.
     */
    public function hasPermission(string $permissionSlug): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        if ($this->roleRelation) {
            return $this->roleRelation->hasPermission($permissionSlug);
        }

        return $this->fallbackHasPermission($permissionSlug);
    }

    /**
     * Determine if user can manage RBAC (users, roles, permissions).
     * Strictly Super Administrator.
     */
    public function canManageRbac(): bool
    {
        return $this->hasPermission('manage-users');
    }

    /**
     * Determine if user can manage site configuration/settings.
     */
    public function canManageSettings(): bool
    {
        return $this->hasPermission('manage-settings');
    }

    /**
     * Determine if user can manage study program profile.
     */
    public function canManageProfile(): bool
    {
        return $this->hasPermission('manage-profile');
    }

    /**
     * Determine if user can manage lecturers and staff.
     */
    public function canManageStaff(): bool
    {
        return $this->hasPermission('manage-staff');
    }

    /**
     * Determine if user can manage academic curricula, courses, calendars, CPL, etc.
     */
    public function canManageAcademic(): bool
    {
        return $this->hasPermission('manage-academic');
    }

    /**
     * Determine if user can manage news, announcements, and events.
     */
    public function canManageNews(): bool
    {
        return $this->hasPermission('manage-news');
    }

    /**
     * Determine if user can manage documentation and photo gallery.
     */
    public function canManageGallery(): bool
    {
        return $this->hasPermission('manage-gallery');
    }

    /**
     * Determine if user can manage lab and facilities.
     */
    public function canManageFacilities(): bool
    {
        return $this->hasPermission('manage-facilities');
    }

    /**
     * Determine if user can manage media files.
     */
    public function canManageMedia(): bool
    {
        return $this->hasPermission('upload-media');
    }

    /**
     * Determine whether the user can access a specific CRUD section.
     */
    public function canAccessSection(string $section): bool
    {
        // Superadmin has unrestricted access to everything
        if ($this->isSuperAdmin()) {
            return true;
        }

        if ($section === 'my-profile') {
            return true;
        }

        $requiredPermission = self::SECTION_PERMISSIONS[$section] ?? null;

        if ($requiredPermission) {
            return $this->hasPermission($requiredPermission);
        }

        return false;
    }

    /**
     * Fallback permission checking when roleRelation is not yet hydrated.
     */
    protected function fallbackHasPermission(string $slug): bool
    {
        return match ($slug) {
            'manage-users', 'manage-settings' => $this->isSuperAdmin(),
            'manage-profile', 'manage-staff', 'manage-academic' => $this->isSuperAdmin() || $this->role === self::ROLE_ADMIN_AKADEMIK,
            'manage-news' => $this->isSuperAdmin() || in_array($this->role, [self::ROLE_ADMIN_KONTEN, self::ROLE_EDITOR], true),
            'manage-gallery' => $this->isSuperAdmin() || $this->role === self::ROLE_ADMIN_KONTEN,
            'manage-facilities' => $this->isSuperAdmin() || $this->role === self::ROLE_OPERATOR_LAB,
            'upload-media' => true,
            default => false,
        };
    }
}
