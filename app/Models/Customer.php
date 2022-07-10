<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'genre',
        'zip_code',
        'state',
        'street',
        'number',
        'box',
        'country',
        'email',
        'mobile',
        'phone',
        'secondary_phone',
        'more_info',
        'has_reminder',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'has_reminder' => 'boolean',
    ];

    /**
     * Get pets of specified customer.
     *
     * @return HasMany
     */
    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class);
    }

    /**
     * Get appointments of specified customer.
     *
     * @return HasMany
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Return customers list as array
     *
     * @return array
     */
    public static function getList(): array
    {
        $customers = Customer::select('id', 'firstname', 'lastname', 'phone')
            ->orderBy('lastname')
            ->orderBy('firstname')
            ->get()
            ->map(function ($item) {
                return [
                    'value' => $item->id, 
                    'label' => $item->getFullName(true),
                ];
            })
            ->toArray();

        return $customers;
    }

    /**
     * Return pets list as options
     *
     * @return array
     */
    public function getPetsAsOptions(): array
    {
        return $this->pets()->orderBy('name')
            ->select('id', 'customer_id', 'name')
            ->get()
            ->map(function ($pet) {
                return [
                    'value' => $pet->id, 
                    'label' => $pet->name,
                ];
            })
            ->toArray();
    }

    /**
     * Return full name and phone number of current customer
     *
     * @param boolean $withPhone
     * @return string
     */
    public function getFullName(bool $withPhone = false): string
    {
        $name = ucfirst($this->lastname) . ' ' . ucfirst($this->firstname);

        if ($withPhone && isset($this->phone)) {
            return $name . (' - ' . $this->phone);
        }

        return $name;
    }
}
