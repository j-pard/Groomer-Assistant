<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    /**
     * Get pets of specified breed.
     *
     * @return HasMany
     */
    public function pets(): HasMany
    {
        return $this->hasMany(Pet::class);
    }

    /**
     * Return breeds list as array
     *
     * @return array
     */
    public static function getAsOptions(): array
    {
        return Breed::orderBy('breed')
        ->get()
        ->map(function ($item) {
            return [
                'value' => $item->id,
                'label' => $item->breed,
            ];
        })
        ->toArray();
    }
}
