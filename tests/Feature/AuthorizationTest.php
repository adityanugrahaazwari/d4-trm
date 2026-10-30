<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test superadmin has full access to all sections.
     */
    public function test_superadmin_has_full_access_to_all_sections(): void
    {
        $superadmin = User::factory()->superadmin()->create();

        $sections = [
            'users',
            'roles',
            'permissions',
            'identitas',
            'kurikulum',
            'dosen',
            'berita',
            'fasilitas',
            'album-galeri',
            'media-list',
            'my-profile',
        ];

        foreach ($sections as $sec) {
            $response = $this->actingAs($superadmin)->get("/admin/crud/{$sec}");
            $response->assertStatus(200);
        }
    }

    /**
     * Test non-superadmin cannot access RBAC management (users, roles, permissions).
     */
    public function test_non_superadmin_cannot_access_rbac_management(): void
    {
        $academicAdmin = User::factory()->adminAkademik()->create();
        $contentAdmin = User::factory()->adminKonten()->create();
        $operatorLab = User::factory()->operatorLab()->create();
        $editor = User::factory()->editor()->create();

        $rbacSections = ['users', 'roles', 'permissions', 'identitas', 'homepage'];

        foreach ([$academicAdmin, $contentAdmin, $operatorLab, $editor] as $user) {
            foreach ($rbacSections as $sec) {
                $response = $this->actingAs($user)->get("/admin/crud/{$sec}");
                $response->assertStatus(403);
                $response->assertSee('Wewenang Tidak Mencukupi');
                $response->assertSee('Kode 403');
            }
        }
    }

    /**
     * Test academic administrator can only access academic modules.
     */
    public function test_academic_admin_domain_access(): void
    {
        $academicAdmin = User::factory()->adminAkademik()->create();

        // Allowed sections
        $allowed = ['kurikulum', 'mata-kuliah', 'kalender', 'cpl', 'profil-lulusan', 'dosen', 'tendik', 'sejarah', 'media-list'];
        foreach ($allowed as $sec) {
            $this->actingAs($academicAdmin)->get("/admin/crud/{$sec}")->assertStatus(200);
        }

        // Disallowed sections
        $disallowed = ['fasilitas', 'album-galeri', 'berita', 'users', 'roles', 'permissions', 'identitas'];
        foreach ($disallowed as $sec) {
            $this->actingAs($academicAdmin)->get("/admin/crud/{$sec}")->assertStatus(403);
        }
    }

    /**
     * Test content administrator domain access.
     */
    public function test_content_admin_domain_access(): void
    {
        $contentAdmin = User::factory()->adminKonten()->create();

        // Allowed sections
        $allowed = ['berita', 'kategori-berita', 'pengumuman', 'agenda', 'album-galeri', 'foto-galeri', 'media-list'];
        foreach ($allowed as $sec) {
            $this->actingAs($contentAdmin)->get("/admin/crud/{$sec}")->assertStatus(200);
        }

        // Disallowed sections
        $disallowed = ['kurikulum', 'dosen', 'fasilitas', 'users', 'roles', 'permissions', 'identitas'];
        foreach ($disallowed as $sec) {
            $this->actingAs($contentAdmin)->get("/admin/crud/{$sec}")->assertStatus(403);
        }
    }

    /**
     * Test lab operator domain access.
     */
    public function test_lab_operator_domain_access(): void
    {
        $operatorLab = User::factory()->operatorLab()->create();

        // Allowed
        $this->actingAs($operatorLab)->get('/admin/crud/fasilitas')->assertStatus(200);
        $this->actingAs($operatorLab)->get('/admin/crud/media-list')->assertStatus(200);

        // Disallowed
        $disallowed = ['kurikulum', 'berita', 'users', 'roles', 'permissions', 'identitas'];
        foreach ($disallowed as $sec) {
            $this->actingAs($operatorLab)->get("/admin/crud/{$sec}")->assertStatus(403);
        }
    }

    /**
     * Test sidebar conditional visibility based on role.
     */
    public function test_sidebar_rbac_menus_visible_only_to_superadmin(): void
    {
        $superadmin = User::factory()->superadmin()->create();
        $academicAdmin = User::factory()->adminAkademik()->create();

        // Superadmin should see RBAC and settings menus
        $superadminResponse = $this->actingAs($superadmin)->get('/admin/dashboard');
        $superadminResponse->assertStatus(200);
        $superadminResponse->assertSee('Pengguna &amp; Peran', false);
        $superadminResponse->assertSee('Daftar Pengguna');
        $superadminResponse->assertSee('Peran (Roles)');
        $superadminResponse->assertSee('Hak Akses (Permissions)');
        $superadminResponse->assertSee('Pengaturan Website');

        // Academic Admin should NOT see RBAC or settings menus
        $academicResponse = $this->actingAs($academicAdmin)->get('/admin/dashboard');
        $academicResponse->assertStatus(200);
        $academicResponse->assertDontSee('Pengguna &amp; Peran', false);
        $academicResponse->assertDontSee('Daftar Pengguna');
        $academicResponse->assertDontSee('Peran (Roles)');
        $academicResponse->assertDontSee('Hak Akses (Permissions)');
        $academicResponse->assertDontSee('Pengaturan Website');
        $academicResponse->assertSee('Kurikulum');
    }
}
