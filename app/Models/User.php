<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
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
     * Check if user is a superadmin.
     */
    public function isSuperAdmin(): bool
    {
        return $this->role === self::ROLE_SUPERADMIN;
    }

    /**
     * Check if user has administrative privileges.
     */
    public function isAdmin(): bool
    {
        return in_array($this->role, [self::ROLE_SUPERADMIN, self::ROLE_ADMIN], true);
    }

    /**
     * Get human-readable role label.
     */
    public function getRoleLabelAttribute(): string
    {
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
     * Determine if user can manage RBAC (users, roles, permissions).
     * Only Super Administrator has this privilege.
     */
    public function canManageRbac(): bool
    {
        return $this->isSuperAdmin();
    }

    /**
     * Determine if user can manage site configuration/settings.
     */
    public function canManageSettings(): bool
    {
        return $this->isSuperAdmin();
    }

    /**
     * Determine if user can manage study program profile.
     */
    public function canManageProfile(): bool
    {
        return $this->isSuperAdmin() || $this->role === self::ROLE_ADMIN_AKADEMIK;
    }

    /**
     * Determine if user can manage lecturers and staff.
     */
    public function canManageStaff(): bool
    {
        return $this->isSuperAdmin() || $this->role === self::ROLE_ADMIN_AKADEMIK;
    }

    /**
     * Determine if user can manage academic curricula, courses, calendars, CPL, etc.
     */
    public function canManageAcademic(): bool
    {
        return $this->isSuperAdmin() || $this->role === self::ROLE_ADMIN_AKADEMIK;
    }

    /**
     * Determine if user can manage news, announcements, and events.
     */
    public function canManageNews(): bool
    {
        return $this->isSuperAdmin() || in_array($this->role, [self::ROLE_ADMIN_KONTEN, self::ROLE_EDITOR], true);
    }

    /**
     * Determine if user can manage documentation and photo gallery.
     */
    public function canManageGallery(): bool
    {
        return $this->isSuperAdmin() || $this->role === self::ROLE_ADMIN_KONTEN;
    }

    /**
     * Determine if user can manage lab and facilities.
     */
    public function canManageFacilities(): bool
    {
        return $this->isSuperAdmin() || $this->role === self::ROLE_OPERATOR_LAB;
    }

    /**
     * Determine if user can manage media files.
     */
    public function canManageMedia(): bool
    {
        return true;
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

        // Strictly restrict users, roles, and permissions to Superadmin only
        if (in_array($section, ['users', 'roles', 'permissions'], true)) {
            return false;
        }

        // Strictly restrict site settings to Superadmin only
        if (in_array($section, ['identitas', 'homepage', 'kontak-sosmed', 'logo-favicon'], true)) {
            return false;
        }

        return match ($this->role) {
            self::ROLE_ADMIN_AKADEMIK => in_array($section, [
                'sejarah', 'visi-misi', 'sambutan', 'struktur',
                'dosen', 'tendik',
                'kurikulum', 'mata-kuliah', 'kalender', 'cpl', 'profil-lulusan',
                'media-list', 'media-upload',
                'my-profile',
            ], true),

            self::ROLE_ADMIN_KONTEN => in_array($section, [
                'berita', 'kategori-berita', 'pengumuman', 'agenda',
                'album-galeri', 'foto-galeri',
                'media-list', 'media-upload',
                'my-profile',
            ], true),

            self::ROLE_OPERATOR_LAB => in_array($section, [
                'fasilitas',
                'media-list', 'media-upload',
                'my-profile',
            ], true),

            self::ROLE_EDITOR => in_array($section, [
                'berita', 'kategori-berita', 'pengumuman', 'agenda',
                'media-list', 'media-upload',
                'my-profile',
            ], true),

            default => ($section === 'my-profile'),
        };
    }
}
