<?php

namespace Database\Factories;

use App\Models\Ninja;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ninja>
 */
class NinjaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Factory will use Faker to generate random data for the Ninja model
            'name' => $this->faker->name(),
            'bio' => $this->faker->realText(500),
            'skill' => $this->faker->numberBetween(0, 100),
            //'rank' => $this->faker->randomElement(['Genin', 'Chunin', 'Jonin', 'Kage']),
            'dojo_id' => \App\Models\Dojo::factory(), // This will create a new Dojo for each Ninja
        ];
    }
}
