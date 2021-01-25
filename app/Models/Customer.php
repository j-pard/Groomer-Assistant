<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uuid',
        'firstname',
        'lastname',
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
        'more_info' => 'array',
    ];

    /**
     * Get pets of specified customer.
     *
     * @return void
     */
    public function pets()
    {
        return $this->hasMany(Pet::class);
    }
}
