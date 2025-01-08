<?php

namespace Database\Factories;

use App\Models\Genre;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->uuid(),
            'title' => fake()->sentence(),
            'synopsis' => fake()->paragraph(),
            'poster' => fake()->imageUrl(),
            'year' => fake()->year(),
            'available' => fake()->boolean(),
            'genre_id' => Genre::inRandomOrder()->first()->id ?? Genre::factory()->create()->id,
        ];
    }
}
