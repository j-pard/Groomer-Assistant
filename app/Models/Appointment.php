<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'price',
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
     * Enum values for TVA status
     *
     * @var array
     */
    public static $tvaStatus = ['cash', 'payconiq', 'bank', 'voucher'];

    /**
     * Return status as option key => value
     *
     * @var array
     */
    public static function getStatusAsOptions(): array
    {
        $array = [
            [
                'value' => 'planned',
                'label' => 'En attente',
            ],
            [
                'value' => 'cash',
                'label' => 'Cash',
            ],
            [
                'value' => 'payconiq',
                'label' => 'Payconiq',
            ],
            [
                'value' => 'bank',
                'label' => 'Virement',
            ],
            [
                'value' => 'private',
                'label' => 'Privé',
            ],
            [
                'value' => 'voucher',
                'label' => 'Voucher',
            ],
            [
                'value' => 'not paid',
                'label' => 'Non payé',
            ],
            [
                'value' => 'cancelled',
                'label' => 'Annulé',
            ],
        ];

        return $array;
    }

    /**
     * Get customer of specified appointment.
     *
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get pet of specified appointment.
     *
     * @return BelongsTo
     */
    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

}
