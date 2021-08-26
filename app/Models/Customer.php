<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        // 
    ];

    // Relations

    /**
     * Get pets of specified customer.
     *
     */
    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    /**
     * Get appointments of specified customer.
     *
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    // Methods
    public static function getList()
    {
        $customers = Customer::select('id', 'firstname', 'lastname', 'phone')->get()
            ->map(function ($item) {
                return ['key' => $item->id, 'value' => ucfirst($item->lastname) . ' ' . ucfirst($item->firstname) . (isset($item->phone) ? (' - ' . $item->phone): '')];
            })
            ->sortBy('value')
            ->pluck('value', 'key')
            ->toArray();

        return [-1 => '---'] + $customers;
    }

    /**
     * Return customers list as options
     *
     * @return array
     */
    public static function getAsOptions()
    {
        return Customer::orderBy('lastname')
            ->orderBy('firstname')
            ->select('lastname', 'firstname', 'id')
            ->get()
            ->map(function ($customer) {
                return ['key' => $customer->id, 'value' => $customer->lastname . ' ' . $customer->firstname];
            })
            ->sortBy('value')
            ->pluck('value', 'key')
            ->toArray();
    }

    /**
     * Return pets list as options
     *
     * @return array
     */
    public function getPetsAsOptions()
    {
        return $this->pets
            ->map(function ($pet) {
                return ['key' => $pet->id, 'value' => $pet->name];
            })
            ->sortBy('value')
            ->pluck('value', 'key')
            ->toArray();
    }
}
