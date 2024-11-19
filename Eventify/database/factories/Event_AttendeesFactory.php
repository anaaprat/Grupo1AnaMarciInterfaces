<?php

namespace Database\Factories;

use App\Http\Controllers\EventAttendeesController;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event_Attendees>
 */
class Event_AttendeesFactory extends Factory
{
    protected $model = EventAttendeesController::class;

    /**
     *
     * @return array
     */
    public function definition()
    {
        return [
            'event_id' => EventFactory::factory(),
            'user_id' => UserFactory::factory(),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled']),
            'register_at' => Carbon::now(),
            'deleted' => $this->faker->boolean(10), 
        ];
    }
}