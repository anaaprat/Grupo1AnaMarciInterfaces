<?php
namespace Tests\Feature;

use App\Models\User;
use App\Models\Events;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;


class CrearEventoTest extends TestCase
{
    use RefreshDatabase;

    public function test_organizador_puede_crear_eventos()
    {
        $user = User::factory()->create(['role' => 'o']);

        $response = $this->post('/events', [
            'title' => 'Test Event',
            'description' => 'Test Description',
            'category_id' => 1,
            'start_time' => now()->addDay(),
            'end_time' => now()->addDays(2),
            'start_date' => now()->addDay()->toDateString(),
            'end_date' => now()->addDays(2)->toDateString(),
            'location' => 'Test Location',
            'latitude' => 12.34,
            'longitude' => 56.78,
            'max_attendees' => 100,
            'price' => 50.00,
            'image_url' => 'default.jpg',
        ]);

        $response->assertStatus(302);
        
    }

    public function test_usuario_no_puede_crear_evento()
    {
        $response = $this->post('/events/store', [
            'title' => 'Unauthorized Event',
        ]);

        $response->assertStatus(405);
        $this->assertDatabaseMissing('events', [
            'title' => 'Unauthorized Event',
        ]);
    }
}
