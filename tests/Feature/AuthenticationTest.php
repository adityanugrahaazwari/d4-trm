<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test login screen can be rendered.
     */
    public function test_login_screen_can_be_rendered(): void
    {
        $response = $this->get('/admin/login');

        $response->assertStatus(200);
        $response->assertSee('Masuk Panel Pengelola');
        $response->assertSee('Alamat Email Pengelola');
    }

    /**
     * Test users can authenticate using the login screen.
     */
    public function test_users_can_authenticate_using_the_login_screen(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@politala.ac.id',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/admin/login', [
            'email' => $user->email,
            'password' => 'password',
            'remember' => true,
        ]);

        $this->assertAuthenticatedAs($user);
        $response->assertRedirect(route('admin.dashboard'));
    }

    /**
     * Test users cannot authenticate with invalid password.
     */
    public function test_users_cannot_authenticate_with_invalid_password(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@politala.ac.id',
            'password' => bcrypt('password'),
        ]);

        $response = $this->from('/admin/login')->post('/admin/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $response->assertRedirect('/admin/login');
        $response->assertSessionHasErrors('email');
    }

    /**
     * Test login requires valid email and password.
     */
    public function test_login_validation_requires_email_and_password(): void
    {
        $response = $this->from('/admin/login')->post('/admin/login', [
            'email' => '',
            'password' => '',
        ]);

        $response->assertRedirect('/admin/login');
        $response->assertSessionHasErrors(['email', 'password']);
    }

    /**
     * Test unauthenticated users are redirected from admin pages.
     */
    public function test_unauthenticated_users_are_redirected_to_login(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertRedirect(route('login'));

        $crudResponse = $this->get('/admin/crud/berita');
        $crudResponse->assertRedirect(route('login'));
    }

    /**
     * Test authenticated users visiting login page are redirected to admin dashboard.
     */
    public function test_authenticated_users_are_redirected_from_login_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/admin/login');

        $response->assertRedirect(route('admin.dashboard'));
    }

    /**
     * Test authenticated users can log out.
     */
    public function test_users_can_logout(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/admin/logout');

        $this->assertGuest();
        $response->assertRedirect(route('login'));
        $response->assertSessionHas('status');
    }

    /**
     * Test rate limiting on consecutive failed login attempts.
     */
    public function test_users_are_rate_limited_after_multiple_failed_attempts(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@politala.ac.id',
            'password' => bcrypt('password'),
        ]);

        for ($i = 0; $i < 5; $i++) {
            $this->post('/admin/login', [
                'email' => $user->email,
                'password' => 'wrong-password',
            ]);
        }

        // 6th attempt should be blocked by rate limiter
        $response = $this->post('/admin/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }
}
