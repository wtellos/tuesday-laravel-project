<?php

namespace Database\Seeders;

use App\Models\User;

//  use Illuminate\Database\Console\Seeds\WithoutModelEvents;
//  Above is used in Laravel's seeders to prevent events from being fired
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    //use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // This is how we can call other seeders from this seeder
        $this->call([
          DojoSeeder::class,
        ]);

        $this->call([
          NinjaSeeder::class,
        ]);        
    }
}
