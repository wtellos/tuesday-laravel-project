<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Role;

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
        // 1. Create roles first
        $this->call([
            RoleSeeder::class,
        ]);

        $memberRole = Role::where('name', 'member')->first();
        $editorRole = Role::where('name', 'editor')->first();

        // 2. Create 10 members
          // $users = User::factory(10)->create();
          // foreach ($users as $user) {
          //     $user->roles()->attach($memberRole);
          // }
        // Members are now created in NinjaFactory because each Ninja is associated with a User, otherwise 10 more are created.

        // 3. Create 1 editor
        $editor = User::factory()->create([
            'name' => 'Editor User',
            'email' => 'editor@example.com',
        ]);
        $editor->roles()->attach($editorRole);

        // 4. Create 1 member
        $member = User::factory()->create([
            'name' => 'Member User',
            'email' => 'member@example.com',
        ]);
        $member->roles()->attach($memberRole);

        // 5. Now create ninjas (they'll use existing users)
        $this->call([
            DojoSeeder::class,
            NinjaSeeder::class,
        ]);
    }
}
