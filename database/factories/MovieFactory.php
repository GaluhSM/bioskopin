<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    protected function ucwordsCompany(): string
    {
        $company = $this->faker->company();
        return collect(explode(' ', $company))
            ->map(fn($word) => ucfirst($word))
            ->implode(' ');
    }

    public function definition(): array
    {
        $title = $this->faker->words(3, true);
        $titleSlug = urlencode(str_replace(' ', ' ', ucwords($title)));

        return [
            'title' => ucwords($title),
            'synopsis' => $this->faker->paragraph(5),
            'poster_url' => "https://placehold.co/300x450.png?text={$titleSlug}",
            'duration_minutes' => $this->faker->numberBetween(90, 180),
            'release_date' => $this->faker->date(),
            'audience_rating' => $this->faker->randomElement(['G', 'PG', 'PG-13', 'R']),
            'producer' => $this->ucwordsCompany(),
            'publisher' => $this->ucwordsCompany(),
            'is_trending' => $this->faker->boolean(20),
            'rating' => $this->faker->randomFloat(1, 7, 9.5),
        ];
    }
}