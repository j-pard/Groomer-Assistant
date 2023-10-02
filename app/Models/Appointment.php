<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Appointment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dog_id',
        'time',
        'price',
        'notes',
        'status',
    ];

    /**
     * Get pet of specified appointment.
     *
     * @return BelongsTo
     */
    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    /**
     * Get dog of specified appointment.
     *
     * @return BelongsTo
     */
    public function dog(): BelongsTo
    {
        return $this->belongsTo(Dog::class);
    }

    /**
     * Interact with the appointment's price.
     */
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => ($value !== null && $value > 0) ? $value . ' €' : '',
        );
    }

    /**
     * Interact with the appointment's short note.
     */
    protected function getShortNoteAttribute(): string
    {
        return $this->notes !== null ? Str::limit(trim($this->notes), 100, ' (...)') : '';
    }

    /**
     * Interact with the appointment's notes.
     */
    protected function notes(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => trim($value),
        );
    }
}

