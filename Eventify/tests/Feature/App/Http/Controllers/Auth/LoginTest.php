<?php

namespace Tests\Feature\App\Http\Controllers\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    
    use RefreshDatabase;

    public function test_user_can_login_with_correct_credentials()
    {
       
        $response = $this->post('/login', [
            'email' => 'marcitabuxtelo@gmail.com',
            'password' => '12345678',
        ]);

        $response->assertStatus(302);
        $response->assertRedirect('/');
        
    }

    public function test_user_cannot_login_with_invalid_credentials()
    {
        $response = $this->post('/login', [
            'email' => 'marcitabustelo@gmail.com',
            'password' => '12345678',
        ]);

        $response->assertStatus(302);
    }
}
