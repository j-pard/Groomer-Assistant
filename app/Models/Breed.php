<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'breed',
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
}
