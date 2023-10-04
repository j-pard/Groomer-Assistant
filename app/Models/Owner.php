<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Owner extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // Will be removed after deploy
        'customer_id',
        'address',
        'city',
        'email',
        'has_reminder',
        'name',
        'phone',
        'secondary_phone',
        'zip_code',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'has_reminder' => 'boolean',
    ];

    /**
     * Get dogs of specified owner.
     *
     * @return HasMany
     */
    public function dogs(): HasMany
    {
        return $this->hasMany(Dog::class);
    }
}
