<?php

namespace Tests\Feature;

use App\Http\Requests\Admin\StoreNewsRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class BackendPatternTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test store role form request validation failure on missing required fields.
     */
    public function test_store_role_form_request_validation_failure_on_missing_required_fields(): void
    {
        $superadmin = User::factory()->superadmin()->create();

        $response = $this->actingAs($superadmin)->post('/admin/rbac/roles', [
            'name' => '',
            'status' => 'invalid-status',
        ]);

        $response->assertSessionHasErrors(['name', 'status']);
        $this->assertEquals('Nama peran wajib diisi.', session('errors')->first('name'));
    }

    /**
     * Test store user form request validation failure on invalid input.
     */
    public function test_store_user_form_request_validation_failure_on_invalid_input(): void
    {
        $superadmin = User::factory()->superadmin()->create();

        $response = $this->actingAs($superadmin)->post('/admin/rbac/users', [
            'name' => '',
            'email' => 'bukan-email',
            'role_id' => 99999,
            'password' => 'short',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'role_id', 'password']);
        $this->assertEquals('Nama pengguna wajib diisi.', session('errors')->first('name'));
        $this->assertEquals('Format email tidak valid.', session('errors')->first('email'));
        $this->assertEquals('Peran yang dipilih tidak ditemukan dalam sistem.', session('errors')->first('role_id'));
        $this->assertEquals('Kata sandi minimal berjumlah 8 karakter.', session('errors')->first('password'));
    }

    /**
     * Test store permission form request validation failure on missing fields.
     */
    public function test_store_permission_form_request_validation_failure_on_missing_fields(): void
    {
        $superadmin = User::factory()->superadmin()->create();

        $response = $this->actingAs($superadmin)->post('/admin/rbac/permissions', [
            'name' => '',
            'module' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'module']);
        $this->assertEquals('Nama hak akses wajib diisi.', session('errors')->first('name'));
        $this->assertEquals('Modul wajib ditentukan.', session('errors')->first('module'));
    }

    /**
     * Test Form Request authorization blocks non-superadmin users.
     */
    public function test_form_requests_authorize_only_users_with_proper_gate(): void
    {
        $editor = User::factory()->editor()->create();

        // Editor attempts to create a role
        $response = $this->actingAs($editor)->post('/admin/rbac/roles', [
            'name' => 'Hacker Role',
        ]);

        $response->assertStatus(403);
    }

    /**
     * Test news form request validation pattern and rule integrity.
     */
    public function test_news_form_request_rules_and_messages_integrity(): void
    {
        $request = new StoreNewsRequest;
        $rules = $request->rules();
        $messages = $request->messages();

        $this->assertArrayHasKey('title', $rules);
        $this->assertArrayHasKey('content', $rules);
        $this->assertArrayHasKey('status', $rules);

        $validator = Validator::make([
            'title' => '',
            'content' => '',
            'status' => 'draft',
        ], $rules, $messages);

        $this->assertTrue($validator->fails());
        $this->assertEquals('Judul berita wajib diisi.', $validator->errors()->first('title'));
        $this->assertEquals('Konten isi berita wajib diisi.', $validator->errors()->first('content'));
    }
}
