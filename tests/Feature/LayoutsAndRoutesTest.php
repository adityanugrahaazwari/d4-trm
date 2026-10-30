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
            '/profil/visi-misi',
            '/akademik/kurikulum',
            '/berita',
            '/berita/d4-trm-politala-jalin-kerjasama-dengan-studio-game-nasional',
            '/fasilitas',
            '/galeri',
            '/agenda',
            '/agenda/kuliah-pakar-pipeline-animasi-3d-studio-hollywood',
            '/kontak',
        ];

        foreach ($routes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);
        }
    }

    /**
     * Test admin dashboard and sample CRUD render properly for authenticated user.
     */
    public function test_admin_dashboard_and_crud_render_properly(): void
    {
        $user = User::factory()->create();

        $dashboard = $this->actingAs($user)->get('/admin/dashboard');
        $dashboard->assertStatus(200);
        $dashboard->assertSee('Dashboard Ringkasan');
        $dashboard->assertSee('Panel Administrasi');

        $crud = $this->actingAs($user)->get('/admin/crud/berita');
        $crud->assertStatus(200);
        $crud->assertSee('Berita Program Studi');
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
