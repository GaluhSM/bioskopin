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
            'synopsis' => $this->faker->paragraph(20),
            'poster_url' => "https://placehold.co/300x450/808080/FFFFFF/png?text={$titleSlug}",
            'duration_minutes' => $this->faker->numberBetween(57, 360),
            'release_date' => $this->faker->date(),
            'audience_rating' => $this->faker->randomElement(['G', 'PG', 'PG-13', 'R']),
            'producer' => $this->ucwordsCompany(),
            'publisher' => $this->ucwordsCompany(),
            'is_trending' => $this->faker->boolean(20),
            'rating' => $this->faker->randomFloat(1, 6, 9.9),
        ];
    }
}