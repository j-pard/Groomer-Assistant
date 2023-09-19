<?php

use App\Enums\DogStatus;
use App\Models\Dog;
use App\Models\Pet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Pet::with('customer')->each(function (Pet $pet) {
            Dog::create([
                'average_duration' => $pet->average_duration,
                'birthdate' => $pet->birthdate,
                'details' => $pet->formatOldDetails(),
                'genre' => $pet->genre,
                'has_warning' => $pet->has_warning,
                'main_breed_id' => $pet->main_breed_id,
                'name' => $pet->name,
                'owner_address' => $pet->customer->address,
                'owner_city' => $pet->customer->city,
                'owner_email' => $pet->customer->email,
                'owner_has_reminder' => $pet->customer->has_reminder,
                'owner_name' => trim($pet->customer->firstname . ' ' . $pet->customer->lastname),
                'owner_phone' => $pet->customer->phone,
                'owner_secondary_phone' => $pet->customer->secondary_phone,
                'owner_zip_code' => $pet->customer->zip_code,
                'second_breed_id' => $pet->second_breed_id,
                'size' => $pet->size,
                'status' => $pet->status === 'not-coming' ? DogStatus::NOT_COMING : $pet->status,
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dogs', function (Blueprint $table) {
            Dog::query()->delete();
        });
    }
};
