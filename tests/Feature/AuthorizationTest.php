<?php

namespace Tests\Feature;

use App\Models\Permission;
use App\Models\Role;
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

    /**
     * Test superadmin can create a new role with specific permissions via database.
     */
    public function test_superadmin_can_create_new_role_with_permissions_dynamically(): void
    {
        $superadmin = User::factory()->superadmin()->create();

        $permAcademic = Permission::where('slug', 'manage-academic')->firstOrFail();
        $permMedia = Permission::where('slug', 'upload-media')->firstOrFail();

        $response = $this->actingAs($superadmin)->post('/admin/rbac/roles', [
            'name' => 'Koordinator Kemahasiswaan',
            'slug' => 'koor-mhs',
            'badge' => 'bg-indigo-100 text-indigo-800 border-indigo-200',
            'description' => 'Mengelola kegiatan kemahasiswaan dan portofolio',
            'permissions' => [$permAcademic->id, $permMedia->id],
        ]);

        $response->assertRedirect('/admin/crud/roles');
        $this->assertDatabaseHas('roles', [
            'name' => 'Koordinator Kemahasiswaan',
            'slug' => 'koor-mhs',
        ]);

        $createdRole = Role::where('slug', 'koor-mhs')->firstOrFail();
        $this->assertCount(2, $createdRole->permissions);
        $this->assertTrue($createdRole->hasPermission('manage-academic'));
        $this->assertTrue($createdRole->hasPermission('upload-media'));
        $this->assertFalse($createdRole->hasPermission('manage-facilities'));
    }

    /**
     * Test updating role permissions dynamically updates user access in real time.
     */
    public function test_dynamic_role_permission_update_immediately_affects_user_access(): void
    {
        $superadmin = User::factory()->superadmin()->create();

        $permAcademic = Permission::where('slug', 'manage-academic')->firstOrFail();
        $permFacilities = Permission::where('slug', 'manage-facilities')->firstOrFail();

        // 1. Create a custom role with only academic permission
        $role = Role::create([
            'name' => 'Staff Akademik Khusus',
            'slug' => 'staff-akademik-khusus',
            'badge' => 'bg-teal-100 text-teal-800 border-teal-200',
        ]);
        $role->permissions()->sync([$permAcademic->id]);

        $staff = User::factory()->create([
            'role' => $role->slug,
            'role_id' => $role->id,
        ]);

        // Staff can access kurikulum, but CANNOT access fasilitas
        $this->actingAs($staff)->get('/admin/crud/kurikulum')->assertStatus(200);
        $this->actingAs($staff)->get('/admin/crud/fasilitas')->assertStatus(403);

        // 2. Superadmin updates the role dynamically to grant facilities permission
        $updateResponse = $this->actingAs($superadmin)->put("/admin/rbac/roles/{$role->id}", [
            'name' => 'Staff Akademik & Lab Khusus',
            'slug' => 'staff-akademik-khusus',
            'badge' => 'bg-teal-100 text-teal-800 border-teal-200',
            'permissions' => [$permAcademic->id, $permFacilities->id],
        ]);
        $updateResponse->assertRedirect('/admin/crud/roles');

        // 3. Now the staff user can immediately access fasilitas!
        $this->actingAs($staff->fresh())->get('/admin/crud/fasilitas')->assertStatus(200);
    }

    /**
     * Test superadmin can create a user assigned to a role dynamically.
     */
    public function test_superadmin_can_create_user_with_role_assignment(): void
    {
        $superadmin = User::factory()->superadmin()->create();
        $academicRole = Role::where('slug', User::ROLE_ADMIN_AKADEMIK)->firstOrFail();

        $response = $this->actingAs($superadmin)->post('/admin/rbac/users', [
            'name' => 'Budi Akademik Baru',
            'email' => 'budi.akademik@trm.ac.id',
            'password' => 'secret1234',
            'password_confirmation' => 'secret1234',
            'role_id' => $academicRole->id,
        ]);

        $response->assertRedirect('/admin/crud/users');

        $this->assertDatabaseHas('users', [
            'email' => 'budi.akademik@trm.ac.id',
            'role_id' => $academicRole->id,
            'role' => $academicRole->slug,
        ]);

        $newUser = User::where('email', 'budi.akademik@trm.ac.id')->firstOrFail();
        $this->actingAs($newUser)->get('/admin/crud/kurikulum')->assertStatus(200);
        $this->actingAs($newUser)->get('/admin/crud/users')->assertStatus(403);
    }

    /**
     * Test non-superadmin cannot access RBAC write endpoints.
     */
    public function test_non_superadmin_cannot_access_rbac_endpoints(): void
    {
        $academicAdmin = User::factory()->adminAkademik()->create();

        $this->actingAs($academicAdmin)->post('/admin/rbac/roles', [
            'name' => 'Illegal Role',
            'slug' => 'illegal-role',
        ])->assertStatus(403);

        $this->actingAs($academicAdmin)->post('/admin/rbac/users', [
            'name' => 'Illegal User',
            'email' => 'hacker@test.com',
        ])->assertStatus(403);

        $this->actingAs($academicAdmin)->post('/admin/rbac/permissions', [
            'name' => 'Illegal Perm',
            'slug' => 'illegal-perm',
        ])->assertStatus(403);
    }

    /**
     * Test user list search and role filtering.
     */
    public function test_user_list_search_and_role_filter(): void
    {
        $superadmin = User::factory()->superadmin()->create(['name' => 'Super User Admin', 'email' => 'super@trm.ac.id']);
        $userA = User::factory()->adminAkademik()->create(['name' => 'Andi Kurniawan', 'email' => 'andi.akademik@trm.ac.id']);
        $userB = User::factory()->adminKonten()->create(['name' => 'Dewi Lestari', 'email' => 'dewi.konten@trm.ac.id']);

        // Search by name "Andi"
        $responseA = $this->actingAs($superadmin)->get('/admin/crud/users?q=Andi');
        $responseA->assertStatus(200);
        $responseA->assertSee('Andi Kurniawan');
        $responseA->assertDontSee('Dewi Lestari');

        // Search by email "dewi.konten"
        $responseB = $this->actingAs($superadmin)->get('/admin/crud/users?q=dewi.konten');
        $responseB->assertStatus(200);
        $responseB->assertSee('Dewi Lestari');
        $responseB->assertDontSee('Andi Kurniawan');

        // Filter by role "admin-akademik"
        $responseRole = $this->actingAs($superadmin)->get('/admin/crud/users?role=admin-akademik');
        $responseRole->assertStatus(200);
        $responseRole->assertSee('Andi Kurniawan');
        $responseRole->assertDontSee('Dewi Lestari');
    }

    /**
     * Test user list pagination.
     */
    public function test_user_list_pagination(): void
    {
        $superadmin = User::factory()->superadmin()->create();

        // Create 12 users
        User::factory()->count(12)->create();

        // Page 1 with 5 per page
        $responsePage1 = $this->actingAs($superadmin)->get('/admin/crud/users?per_page=5&page=1');
        $responsePage1->assertStatus(200);
        $responsePage1->assertSee('Menampilkan');
        $responsePage1->assertSee('sampai');
        $responsePage1->assertSee('data terdaftar');
        $responsePage1->assertSee('Selanjutnya');

        // Page 2 with 5 per page
        $responsePage2 = $this->actingAs($superadmin)->get('/admin/crud/users?per_page=5&page=2');
        $responsePage2->assertStatus(200);
        $responsePage2->assertSee('Sebelumnya');
        $responsePage2->assertSee('Selanjutnya');
    }

    /**
     * Test roles search and status filtering.
     */
    public function test_roles_search_and_filtering(): void
    {
        $superadmin = User::factory()->superadmin()->create();

        // Search role by name
        $response = $this->actingAs($superadmin)->get('/admin/crud/roles?q=Akademik');
        $response->assertStatus(200);
        $response->assertSee('Administrator Akademik');
        $response->assertDontSee('Operator Lab &amp; Fasilitas', false);
    }

    /**
     * Test permissions search and module filtering.
     */
    public function test_permissions_search_and_filtering(): void
    {
        $superadmin = User::factory()->superadmin()->create();

        // Search permission by slug
        $response = $this->actingAs($superadmin)->get('/admin/crud/permissions?q=manage-news');
        $response->assertStatus(200);
        $response->assertSee('manage-news');
        $response->assertDontSee('manage-facilities');

        // Filter permission by module
        $responseModule = $this->actingAs($superadmin)->get('/admin/crud/permissions?module='.urlencode('Sarana & Prasarana'));
        $responseModule->assertStatus(200);
        $responseModule->assertSee('manage-facilities');
        $responseModule->assertDontSee('manage-academic');
    }
}
