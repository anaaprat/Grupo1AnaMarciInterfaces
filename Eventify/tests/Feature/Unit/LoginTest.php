<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'email' => 'marcitabuxtelo@gmail.com',
            'password' => bcrypt('12345678'),
            'email_verified_at' => now(),
            'email_confirmed' => 1,
            'actived' => 1,
        ]);
    }

    public function test_user_can_login_with_correct_credentials()
    {
        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => '12345678',
        ]);

        $this->assertAuthenticatedAs($this->user);
        $response->assertRedirect('/');
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        $response = $this->post('/login', [
            'email' => $this->user->email,
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(302);
    }
}
