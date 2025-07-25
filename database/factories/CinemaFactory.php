<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CinemaFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'Bioskop ' . $this->faker->city(),
            'location' => $this->faker->address(),
        ];
    }
}