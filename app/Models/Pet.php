<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //
    ];

    /**
     * Array of size options
     *
     * @var array
     */
    protected static $sizeOptions = [
        'dwarf' => 'nain',
        'small' => 'petit',
        'medium' => 'moyen',
        'big' => 'grand',
        'giant' => 'géant',
    ];

    /**
     * Array of size options
     *
     * @var array
     */
    protected static $status = [
        'active' => 'Actif',
        'not-coming' => 'Ne vient plus',
        'dead' => 'Décédé',
    ];

    // Relations

    /**
     * Get customer of specified pet.
     *
     * @return void
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get main breed of specified pet.
     *
     * @return void
     */
    public function mainBreed()
    {
        return $this->belongsTo(Breed::class, 'main_breed_id');
    }

    /**
     * Get secondary breed of specified pet.
     *
     * @return void
     */
    public function secondBreed()
    {
        return $this->belongsTo(Breed::class, 'second_breed_id');
    }

    /**
     * Get appointments of specified pet.
     *
     * @return void
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    // Methods

    /**
     * Return duration in hours and minutes
     *
     * @return Array
     */
    public function getDurationInHoursMinutes()
    {
        $duration = $this->average_duration;

        return [
            'hours' => floor($duration / 60),
            'minutes' => $duration % 60,
        ];
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

    public static function getSizeOptions()
    {
        return self::$sizeOptions;
    }

    public static function getStatus()
    {
        return self::$status;
    }

    /**
     * Return duration in hours and minutes
     *
     * @return Array
     */
    public static function getOrphansList()
    {
        return Pet::whereNull('customer_id')->orderBy('name')->pluck('name', 'id')->toArray();
    }
}
