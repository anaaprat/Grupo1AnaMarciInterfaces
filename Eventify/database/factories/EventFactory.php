<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Event;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        return [
            'organized_id' => User::factory(),
            'title' => $this->faker->sentence(5),
            'description' => $this->faker->paragraph(3),
            'category_id' => $this->faker->numberBetween(1, 10),
            'start_time' => $this->faker->dateTimeBetween('+1 days', '+1 months'),
            'end_time' => $this->faker->dateTimeBetween('+1 months', '+2 months'),
            'location' => $this->faker->address(),
            'latitude' => $this->faker->latitude(-90, 90),
            'longitude' => $this->faker->longitude(-180, 180),
            'max_attendees' => $this->faker->numberBetween(10, 1000),
            'price' => $this->faker->randomFloat(2, 0, 500),
            'image_url' => $this->faker->imageUrl(640, 480, 'event'),
            'deleted' => 0,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function forOrganizer($userId)
    {
        return $this->state(function (array $attributes) use ($userId) {
            return [
                'organized_id' => $userId,
            ];
        });
    }


}
