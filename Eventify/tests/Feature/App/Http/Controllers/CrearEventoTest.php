<?php

namespace Tests\Feature\App\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CrearEventoTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_can_create_event()
    {

        $response = $this->post('/events', [
            'title' => 'FP week',
            'description' => 'semana de charla fp week',
            'category_id' => '3',
            'start_date' => '2025-02-14 19:15:00',
            'start_time' => '2025-02-19 19:15:00',
            'location' => 'Cadiz',
            'max_attendees' => '30',
            'price' => '0',
            'image_file' => 'default.jpg'
            ,
        ]);

        $response->assertStatus(302);
    }

    public function test_events_fails_with_invalid_data()
    {

        $response = $this->post('/events', [
            'title' => '',
            'description' => 'semana de charla fp week',
            'category_id' => '3',
            'start_date' => '19:15:00',
            'start_time' => '2025-02-19 19:15:00',
            'location' => 'Cadiz',
            'max_attendees' => '30',
            'price' => '0',
            'image_file' => 'default.jpg'
            ,
        ]);

        $response->assertStatus(302);
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
    }
}
