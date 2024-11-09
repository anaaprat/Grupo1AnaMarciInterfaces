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
        \App\Models\User::factory()->count(20)->create();
        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => '12345678',
            'actived' => 1,
            'email_confirmed' => 1,
            'role' => 'a',
        ]);
        \App\Models\User::factory()->create([
            'name' => 'Marcita',
            'email' => 'marcitabuxtelo@gmail.com',
            'password' => '12345678',
            'actived' => 1,
            'email_confirmed' => 1,
            'role' => 'o',
        ]);
        \App\Models\Category::factory()->create([
            'name' => 'music',
            'description' => 'Category for music events',
        ]);
        
        \App\Models\Category::factory()->create([
            'name' => 'sport',
            'description' => 'Category for sport events',
        ]);
        
        \App\Models\Category::factory()->create([
            'name' => 'technology',
            'description' => 'Category for technology events',
        ]);
        \App\Models\Event::factory()->count(10)->forOrganizer(22)->create();
        
    }
}