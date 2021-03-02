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
        'birthdate',
        'status',
        'average_duration',
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
     * Get customer of specified pet.
     *
     * @return void
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Return available status
     *
     * @return Array
     */
    public static function getStatus()
    {
        return 
        [
            'active' => 'Actif',
            'not going' => 'Ne vient plus',
            'dead' => 'Décédé',
        ];
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
}
