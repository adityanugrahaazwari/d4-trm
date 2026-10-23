<?php

namespace Tests\Feature;

use Tests\TestCase;

class LayoutsAndRoutesTest extends TestCase
{
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
            '/fasilitas',
            '/galeri',
            '/kontak',
        ];

        foreach ($routes as $route) {
            $response = $this->get($route);
            $response->assertStatus(200);
        }
    }

    /**
     * Test admin dashboard and sample CRUD render properly.
     */
    public function test_admin_dashboard_and_crud_render_properly(): void
    {
        $dashboard = $this->get('/admin/dashboard');
        $dashboard->assertStatus(200);
        $dashboard->assertSee('Dashboard Ringkasan');
        $dashboard->assertSee('Panel Administrasi');

        $crud = $this->get('/admin/crud/berita');
        $crud->assertStatus(200);
        $crud->assertSee('Manajemen Berita');
    }
}
