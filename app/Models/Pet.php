<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class Pet extends Model implements HasMedia
{
    use InteractsWithMedia;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'type',
        'name',
        'genre',
        'main_breed_id',
        'secondary_breed_id',
        'birthdate',
        'status',
        'average_duration',
        'size',
        'remarks',
        'has_warning',
        'warnings',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'has_warning' => 'boolean',
    ];

    /**
     * Array of size options
     *
     * @var array
     */
    protected static $sizeOptions = [
        'dwarf' => 'Nain',
        'small' => 'Petit',
        'medium' => 'Moyen',
        'big' => 'Grand',
        'giant' => 'Géant',
    ];

    /**
     * Array of size options
     *
     * @var array
     */
    public static $status = [
        'active' => 'Actif',
        'private' => 'Privé',
        'not-coming' => 'Ne vient plus',
        'dead' => 'Décédé',
    ];

    /**
     * Get customer of specified pet.
     *
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get main breed of specified pet.
     *
     * @return BelongsTo
     */
    public function mainBreed(): BelongsTo
    {
        return $this->belongsTo(Breed::class, 'main_breed_id');
    }

    /**
     * Get secondary breed of specified pet.
     *
     * @return BelongsTo
     */
    public function secondBreed(): BelongsTo
    {
        return $this->belongsTo(Breed::class, 'second_breed_id');
    }

    /**
     * Get appointments of specified pet.
     *
     * @return HasMany
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Set the pet's name.
     *
     * @param  string  $value
     * @return void
     */
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucfirst(strtolower($value));
    }

    /**
     * Get the pet's name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->status === 'private' ? $this->name . ' <i class="fab fa-product-hunt ms-1 text-secondary"></i>' : $this->name;
    }

    /**
     * Return duration in hours and minutes
     *
     * @return Array
     */
    public function getDurationInHoursMinutes(): array
    {
        $duration = $this->average_duration;

        return [
            'hours' => floor($duration / 60),
            'minutes' => $duration % 60,
        ];
    }

    /**
     * Return sizes as options list
     *
     * @return array
     */
    public static function getSizeOptions(): array
    {
        return self::$sizeOptions;
    }

    /**
     * Return status as options list
     *
     * @return array
     */
    public static function getStatus(): array
    {
        return self::$status;
    }

    /**
     * Return duration in hours and minutes
     *
     * @return Array
     */
    public static function getOrphansList(): array
    {
        return Pet::whereNull('customer_id')->orderBy('name')->pluck('name', 'id')->toArray();
    }
}
