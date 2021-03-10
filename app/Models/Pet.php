<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'customer_id',
        'type',
        'name',
        'genre',
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
}
