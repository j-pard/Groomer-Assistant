<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Dog extends Model implements HasMedia
{
    use InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'average_duration',
        'birthdate',
        'details',
        'genre',
        'has_warning',
        'main_breed_id',
        'name',
        'owner_id',
        'second_breed_id',
        'size',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'has_warning' => 'boolean',
    ];

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['owner'];

    /**
     * Get appointments of specified dog.
     *
     * @return HasMany
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Get main breed of specified dog.
     *
     * @return BelongsTo
     */
    public function mainBreed(): BelongsTo
    {
        return $this->belongsTo(Breed::class, 'main_breed_id');
    }

    /**
     * Get owner of specified dog.
     *
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(Owner::class);
    }

    /**
     * Get secondary breed of specified dog.
     *
     * @return BelongsTo
     */
    public function secondBreed(): BelongsTo
    {
        return $this->belongsTo(Breed::class, 'second_breed_id');
    }

    /**
     * Get the dogs's most recent appointment.
     *
     * @return HasOne
     */
    public function latestAppointment(): HasOne
    {
        return $this->hasOne(Appointment::class)->ofMany('time', 'max');
    }

    /**
     * Get the dog's name.
     */
    protected function name(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => ucfirst($value),
        );
    }

    /**
     * Get the dog's owner name.
     */
    protected function ownerName(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucfirst($value),
            set: fn (string $value) => ucfirst($value),
        );
    }

    /**
     * Return duration in hours and minutes
     *
     * @return array
     */
    public function getDurationInHoursMinutes(): array
    {
        return [
            'hours' => intval(floor($this->average_duration / 60)),
            'minutes' => intval($this->average_duration % 60),
        ];
    }

    public function getAvatarAttribute(): string
    {
        return strtoupper(substr($this->name, 0, 1) . substr($this->owner->name ?? '', 0, 1));
    }
}
