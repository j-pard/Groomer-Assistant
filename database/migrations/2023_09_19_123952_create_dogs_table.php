<?php

use App\Enums\DogSizes;
use App\Enums\DogStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dogs', function (Blueprint $table) {
            $table->id();

            // Breeds
            $table->unsignedBigInteger('main_breed_id')->nullable();
            $table->foreign('main_breed_id')->references('id')->on('breeds');
            $table->unsignedBigInteger('second_breed_id')->nullable();
            $table->foreign('second_breed_id')->references('id')->on('breeds');

            // Details
            $table->string('name', 100);
            $table->enum('genre', ['unknown', 'male', 'female'])->default('unknown');
            $table->string('size', 50)->default(DogSizes::MEDIUM);
            $table->string('status', 50)->default(DogStatus::ACTIVE);
            $table->string('birthdate', 50)->nullable();
            $table->unsignedInteger('average_duration')->nullable();
            $table->boolean('has_warning')->default(false);
            $table->text('details')->nullable();

            // Owner details
            $table->string('owner_name', 100);
            $table->string('owner_phone', 50);
            $table->string('owner_secondary_phone', 50)->nullable();
            $table->string('owner_email', 100)->nullable();
            $table->string('owner_address', 255)->nullable();
            $table->integer('owner_zip_code', 20)->nullable();
            $table->string('owner_city', 100)->nullable();
            $table->boolean('owner_has_reminder')->default(false);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dogs');
    }
};
