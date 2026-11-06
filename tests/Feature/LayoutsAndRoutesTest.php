<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LayoutsAndRoutesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test public home page loads successfully.
     */
    public function test_homepage_is_accessible(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Teknik Rekayasa Multimedia');
        $response->assertSee('Kurikulum');
        $response->assertDontSee('Karya Mahasiswa');
    }

    /**
     * Test public subpages load successfully.
     */
    public function test_public_subpages_are_accessible(): void
    {
        $routes = [
            '/profil/sejarah',
            '/profil/visi-misi',
            '/profil/sambutan-kaprodi',
            '/profil/struktur-organisasi',
            '/profil/dosen',
            '/profil/tenaga-kependidikan',
            '/akademik/kurikulum',
            '/akademik/kalender-akademik',
            '/akademik/capaian-pembelajaran',
            '/akademik/profil-lulusan',
            '/berita',
            '/berita/d4-trm-politala-jalin-kerjasama-dengan-studio-game-nasional',
            '/pengumuman',
            '/agenda',
            '/agenda/kuliah-pakar-pipeline-animasi-3d-studio-hollywood',
            '/fasilitas',
            '/galeri',
            '/kontak',
        ];

        foreach ($routes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);
        }

        // Test redirect route
        $courseRedirect = $this->get('/akademik/mata-kuliah');
        $courseRedirect->assertStatus(302);
    }

    /**
     * Test admin dashboard and sample CRUD render properly for authenticated superadmin.
     */
    public function test_admin_dashboard_and_crud_render_properly(): void
    {
        $user = User::factory()->superadmin()->create();

        $dashboard = $this->actingAs($user)->get('/admin/dashboard');
        $dashboard->assertStatus(200);
        $dashboard->assertSee('Dashboard Ringkasan');
        $dashboard->assertSee('Panel Administrasi');
        $dashboard->assertSee('Live DB');
        $dashboard->assertDontSee('[Dummy]');

        $home = $this->get('/');
        $home->assertStatus(200);
        $home->assertDontSee('[Data Contoh #1]');

        $crud = $this->actingAs($user)->get('/admin/crud/berita');
        $crud->assertStatus(200);
        $crud->assertSee('Berita Program Studi');

        $usersCrud = $this->actingAs($user)->get('/admin/crud/users');
        $usersCrud->assertStatus(200);
        $usersCrud->assertSee('Manajemen Pengguna');
        $usersCrud->assertSee($user->email);

        $rolesCrud = $this->actingAs($user)->get('/admin/crud/roles');
        $rolesCrud->assertStatus(200);
        $rolesCrud->assertSee('Manajemen Peran (Roles)');
        $rolesCrud->assertSee('superadmin');
        $rolesCrud->assertSee('Super Administrator');

        $permissionsCrud = $this->actingAs($user)->get('/admin/crud/permissions');
        $permissionsCrud->assertStatus(200);
        $permissionsCrud->assertSee('Hak Akses Sistem (Permissions)');
        $permissionsCrud->assertSee('manage-users');
        $permissionsCrud->assertSee('manage-academic');

        // Test all 28 admin CRUD sections render without errors
        $allSections = [
            'sejarah', 'visi-misi', 'sambutan', 'struktur',
            'dosen', 'tendik',
            'kurikulum', 'mata-kuliah', 'kalender', 'cpl', 'profil-lulusan',
            'berita', 'kategori-berita', 'pengumuman', 'agenda',
            'fasilitas', 'album-galeri', 'foto-galeri',
            'identitas', 'homepage', 'kontak-sosmed', 'logo-favicon',
            'media-list', 'media-upload',
            'users', 'roles', 'permissions', 'my-profile',
        ];

        foreach ($allSections as $section) {
            $response = $this->actingAs($user)->get("/admin/crud/{$section}");
            $response->assertStatus(200);
        }
    }

    /**
     * Test splash screen is rendered on public and admin pages.
     */
    public function test_splash_screen_renders_on_pages(): void
    {
        $home = $this->get('/');
        $home->assertStatus(200);
        $home->assertSee('page-splash-screen');
        $home->assertSee('Memuat halaman');

        $user = User::factory()->create();
        $admin = $this->actingAs($user)->get('/admin/dashboard');
        $admin->assertStatus(200);
        $admin->assertSee('page-splash-screen');
        $admin->assertSee('Memuat halaman');
    }
}
