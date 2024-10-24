<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        // Crea 20 usuarios utilizando la factory
        \App\Models\User::factory()->count(20)->create();
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '12345678',
            'activated' => 'true',
            'email_confirmed' => 'true',
            'role' => 'admin',
        ]);
    }
}