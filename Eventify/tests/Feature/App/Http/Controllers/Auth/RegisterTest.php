<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_register()
    {
        $response = $this->post('/register', [
            'role' => 'user',
            'name' => 'Marcita Bustelo',
            'email' => 'bustelo.brmar21@cadiz.salesianos.edu',
            'password' => '123123123',
            'password_confirmation' => '123123123',
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('users', [
            'email' => 'bustelo.brmar21@cadiz.salesianos.edu',
        ]);
    }

    public function test_registration_fails_with_invalid_data()
    {
        $response = $this->post('/register', [
            'role' => 'u',
            'name' => '',
            'email' => 'bustel',
            'password' => '123123123',
            'password_confirmation' => '123123123',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['role', 'name', 'email']);
    }
}
