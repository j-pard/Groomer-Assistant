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
        'uuid',
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
     * @return void
     */
    public function pets()
    {
        return $this->hasMany(Pet::class);
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
}
