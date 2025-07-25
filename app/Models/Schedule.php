<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'studio_id',
        'start_time',
        'end_time',
        'price',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    /**
     * Get the movie for this schedule.
     */
    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }

    /**
     * Get the studio for this schedule.
     */
    public function studio(): BelongsTo
    {
        return $this->belongsTo(Studio::class);
    }

    /**
     * Get the bookings for this schedule.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}