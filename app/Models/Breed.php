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
     * Get dogs of specified breed.
     *
     * @return HasMany
     */
    public function dogs(): HasMany
    {
        return $this->hasMany(Dog::class);
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
        ->map(function (Breed $breed) {
            return [
                'value' => $breed->id,
                'label' => $breed->breed,
            ];
        })
        ->toArray();
    }
}
