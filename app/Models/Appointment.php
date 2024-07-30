<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    public const DEFAULT_TIME = '08:30';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dog_id',
        'time',
        'price',
        'status',
        'duration',
        'notes',
    ];

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
     * Interact with the appointment's notes.
     */
    protected function notes(): Attribute
    {
        return Attribute::make(
            set: fn (?string $value) => $value !== null ? trim($value) : null,
        );
    }

    /**
     * Interact with the appointment's duration.
     * Store null if 0 is given.
     */
    protected function duration(): Attribute
    {
        return Attribute::make(
            set: fn (?string $value) => $value > 0 ? $value : null,
        );
    }

    /**
     * Return price with currency.
     *
     * @return string
     */
    public function getPriceAsString(): string
    {
        return $this->price . (($this->price !== null) ? ' €' : '');
    }

    /**
     * Return duration in hours and minutes
     *
     * @return array
     */
    public function getDurationInHoursMinutes(): array
    {
        return [
            'hours' => intval(floor($this->duration / 60)),
            'minutes' => intval($this->duration % 60),
        ];
    }

    /**
     * Return formated appointment duration.
     *
     * @param Appointment $appointment
     * @return string
     */
    public function getDurationAsString(): string
    {
        // Assure minimum 2 digits
        $hours = str_pad(floor($this->duration / 60), 2, '0', STR_PAD_LEFT);
        $minutes = str_pad($this->duration % 60, 2, '0', STR_PAD_LEFT);

        return "{$hours}h{$minutes}";
    }
}
