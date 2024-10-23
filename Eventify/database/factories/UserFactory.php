<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'), // password
            'role' => $this->faker->randomElement(['User', 'Admin']), // Rol aleatorio entre User y Admin
            'profile_picture' => 'default.jpg',  // Puedes usar un valor por defecto o generar imágenes
            'actived' => $this->faker->boolean(), // Valor booleano aleatorio
            'email_confirmed' => $this->faker->boolean(), // Booleano aleatorio
            'deleted' => 0,  // Inicialmente, no está borrado
            'remember_token' => Str::random(10), // Token aleatorio
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
