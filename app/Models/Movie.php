<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'synopsis',
        'poster_url',
        'duration_minutes',
        'release_date',
        'audience_rating',
        'producer',
        'publisher',
        'is_trending',
        'rating',
    ];

    /**
     * Get the schedules for the movie.
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}