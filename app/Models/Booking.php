<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'schedule_id',
        'customer_name',
        'customer_phone',
        'status',
        'unique_code',
    ];

    /**
     * Get the schedule for this booking.
     */
    public function schedule(): BelongsTo
    {
        return $this->belongsTo(Schedule::class);
    }

    /**
     * The seats that belong to this booking.
     */
    public function seats(): BelongsToMany
    {
        return $this->belongsToMany(Seat::class, 'booking_seat');
    }
}