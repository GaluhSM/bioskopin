<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = ['studio_id', 'row', 'number'];

    public $timestamps = false;

    /**
     * Get the studio that owns the seat.
     */
    public function studio(): BelongsTo
    {
        return $this->belongsTo(Studio::class);
    }

    /**
     * The bookings that include this seat.
     */
    public function bookings(): BelongsToMany
    {
        return $this->belongsToMany(Booking::class, 'booking_seat');
    }
}