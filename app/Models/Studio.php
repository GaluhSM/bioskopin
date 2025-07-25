<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Studio extends Model
{
    use HasFactory;

    protected $fillable = ['cinema_id', 'name', 'capacity'];

    /**
     * Get the cinema that owns the studio.
     */
    public function cinema(): BelongsTo
    {
        return $this->belongsTo(Cinema::class);
    }

    /**
     * Get the seats for the studio.
     */
    public function seats(): HasMany
    {
        return $this->hasMany(Seat::class);
    }

    /**
     * Get the schedules for the studio.
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}