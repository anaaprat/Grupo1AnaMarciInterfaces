<?php
namespace Tests\Feature\App\Http\Controllers;

use App\Models\User;
use App\Models\Event;
use App\Models\Category;  // Asegúrate de importar el modelo de Category
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EliminarEventoTest extends TestCase
{
    use RefreshDatabase;

    public function test_organizador_puede_eliminar_evento()
    {
        $user = User::factory()->create(['role' => 'o']);
        $category = Category::factory()->create();
        $event = Event::factory()->create([
            'organized_id' => $user->id,  
            'category_id' => $category->id,  
        ]);
    
        $response = $this->actingAs($user)->delete("/events/{$event->id}");    
        $response->assertStatus(302);

    }
    

    public function test_usuario_no_autorizado_no_puede_eliminar_evento()
    {
        $user = User::factory()->create(['role' => 'u']);  

        $category = Category::factory()->create();
        $event = Event::factory()->create([
            'organized_id' => User::factory()->create(['role' => 'o'])->id, 
            'category_id' => $category->id,  
        ]);

        $response = $this->actingAs($user)->delete("/events/{$event->id}");

        $response->assertStatus(302);
        $this->assertDatabaseHas('events', [
            'id' => $event->id,
        ]);
    }
}
