<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3, true),
            'synopsis' => $this->faker->paragraph(5),
            'poster_url' => 'https://via.placeholder.com/300x450.png?text=Movie+Poster',
            'duration_minutes' => $this->faker->numberBetween(90, 180),
            'release_date' => $this->faker->date(),
            'audience_rating' => $this->faker->randomElement(['G', 'PG', 'PG-13', 'R']),
            'producer' => $this->faker->company(),
            'publisher' => $this->faker->company(),
            'is_trending' => $this->faker->boolean(20),
            'rating' => $this->faker->randomFloat(1, 7, 9.5),
        ];
    }
}