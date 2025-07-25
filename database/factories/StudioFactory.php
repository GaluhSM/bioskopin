<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudioFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'Studio ' . $this->faker->randomDigitNotNull(),
            'capacity' => $this->faker->randomElement([50, 70, 100]),
        ];
    }
}