<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;
use App\Models\User;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function test_user_can_register(): void
    {
        $response = $this->post('/register', [
            'name' => 'Fadhil',
            'noHp' => '085756956684',
            'password' => 'password',
            'role' => 'user',
        ]);

        $response->assertRedirect('/login');

        $this->assertGuest();

        $this->assertDatabaseHas('users', [
            'name' => 'Fadhil',
            'noHp' => '085756956684',
            'role' => 'user',
        ]);
    }

    public function test_user_can_login_with_noHp_and_password(): void
    {
        $user = User::factory()->create([
            'name' => 'Fadhil',
            'noHp' => '085756956684',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $response = $this->post('/login', [
            'noHp' => '085756956684',
            'password' => 'password',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticatedAs($user);
    }

    public function test_login_fails_with_wrong_password(): void
    {
        $user = User::factory()->create([
            'name' => 'fadhil',
            'noHp' => '085756956684',
            'password' => bcrypt('password'),
        ]);

        $response = $this->post('/login', [
            'noHp' => '085756956684',
            'password' => 'wrongpass',
        ]);

        $response->assertRedirect('/login');
        $this->assertGuest();
    }

    public function test_guest_cannot_access_dashboard(): void
    {
        $response = $this->get('/dashboard/admin');

        $response->assertRedirect('/login');
        $this->assertGuest();
    }
}
