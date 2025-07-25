<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Movie;
use App\Models\Studio;
use Carbon\Carbon;

class ScheduleFactory extends Factory
{
    public function definition(): array
    {
        $startTime = Carbon::now()->addDays(rand(0, 7))->setHour(rand(10, 20))->setMinutes(rand(0, 1) * 30);
        $movie = Movie::inRandomOrder()->first();

        return [
            'movie_id' => $movie->id,
            'studio_id' => Studio::inRandomOrder()->first()->id,
            'start_time' => $startTime,
            'end_time' => (clone $startTime)->addMinutes($movie->duration_minutes),
            'price' => $this->faker->randomElement([35000, 40000, 50000, 65000]),
        ];
    }
}