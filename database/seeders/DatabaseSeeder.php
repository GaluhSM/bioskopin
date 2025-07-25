<?php

namespace Database\Seeders;

use App\Models\Movie;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CinemaSeeder::class,
        ]);

        Movie::factory(20)->create();

        Schedule::factory(50)->create();
    }
}