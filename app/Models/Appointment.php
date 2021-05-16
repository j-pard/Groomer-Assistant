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
        'status',
    ];

    /**
     * Enum values for status
     *
     * @var array
     */
    protected $status = [
        0 => 'planned',
        1 => 'cash',
        2 => 'payconiq',
        3 => 'bank',
        4 => 'private',
        5 => 'voucher',
        6 => 'not paid',
        7 => 'cancelled',
    ];

    /**
     * Return status as option key => value
     *
     * @var array
     */
    public static function getStatusAsOptions()
    {
        return [
            'planned' => 'En attente',
            'cash' => 'Cash',
            'payconiq' => 'Payconiq',
            'bank' => 'Virement',
            'private' => 'Privé',
            'voucher' => 'Voucher',
            'not paid' => 'Non payé',
            'cancelled' => 'Annulé',
        ];
    }

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
