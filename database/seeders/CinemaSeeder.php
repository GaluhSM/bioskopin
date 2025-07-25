<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cinema;
use App\Models\Studio;
use App\Models\Seat;

class CinemaSeeder extends Seeder
{
    public function run(): void
    {
        Cinema::factory(3)->create()->each(function ($cinema) {
            Studio::factory(4)->create(['cinema_id' => $cinema->id])->each(function ($studio) {
                $rows = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H'];
                $seatsPerRow = $studio->capacity / count($rows);

                foreach ($rows as $row) {
                    for ($i = 1; $i <= $seatsPerRow; $i++) {
                        Seat::create([
                            'studio_id' => $studio->id,
                            'row' => $row,
                            'number' => $i,
                        ]);
                    }
                }
            });
        });
    }
}