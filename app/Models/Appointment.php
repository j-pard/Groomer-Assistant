<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Appointment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id',
        'pet_id',
        'time',
        'notes',
    ];

    // Relations

    /**
     * Get customer of specified appointment.
     *
     * @return Customer
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get pet of specified appointment.
     *
     * @return Pet
     */
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

}
