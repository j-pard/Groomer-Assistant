<?php

use App\Enums\DogStatus;
use App\Models\Dog;
use App\Models\Owner;
use App\Models\Pet;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Pet::with('customer')->whereNotNull('customer_id')->each(function (Pet $pet) {
            $owner = Owner::where('customer_id', $pet->customer_id)->first();
            if ($owner === null) {
                $owner = Owner::create([
                    // Will be removed after data mirgation
                    'customer_id' => $pet->customer_id,
                    'address' => $pet->customer->address,
                    'city' => $pet->customer->city,
                    'email' => $pet->customer->email,
                    'has_reminder' => $pet->customer->has_reminder,
                    'name' => trim(ucfirst($pet->customer->firstname) . ' ' . ucfirst($pet->customer->lastname)),
                    'phone' => $pet->customer->phone,
                    'secondary_phone' => $pet->customer->secondary_phone,
                    'zip_code' => $pet->customer->zip_code,
                ]);
            }

            $dog = Dog::create([
                'average_duration' => $pet->average_duration,
                'birthdate' => $pet->birthdate,
                'details' => $pet->formatOldDetails(),
                'genre' => $pet->genre,
                'has_warning' => $pet->has_warning,
                'main_breed_id' => $pet->main_breed_id,
                'name' => $pet->name,
                'owner_id' => $owner->id,
                'second_breed_id' => $pet->second_breed_id,
                'size' => $pet->size,
                'status' => $pet->status === 'not-coming' ? DogStatus::NOT_COMING : $pet->status,
            ]);

            // Migrate appointments
            $pet->appointments()->update([
                'dog_id' => $dog->id,
            ]);

            // Migrate medias
            $pet->media()->update([
                'model_type' => 'App\Models\Dog',
                'model_id' => $dog->id,
            ]);
        });

        // Remove customer_id when data migration is completed
        Schema::table('owners', function (Blueprint $table) {
            $table->dropColumn('customer_id');
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

        Schema::table('owners', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id')->nullable();
        });
    }
};
