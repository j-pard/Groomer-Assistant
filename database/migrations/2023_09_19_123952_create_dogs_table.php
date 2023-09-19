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
            $table->string('name', 255);
            $table->enum('genre', ['unknown', 'male', 'female'])->default('unknown');
            $table->string('size', 50)->default(DogSizes::MEDIUM);
            $table->string('status', 50)->default(DogStatus::ACTIVE);
            $table->string('birthdate')->nullable();
            $table->unsignedInteger('average_duration')->nullable();
            $table->boolean('has_warning')->default(false);
            $table->text('details')->nullable();

            // Owner details
            $table->string('owner_name');
            $table->string('owner_phone');
            $table->string('owner_secondary_phone')->nullable();
            $table->string('owner_email')->nullable();
            $table->string('owner_address')->nullable();
            $table->integer('owner_zip_code')->nullable();
            $table->string('owner_city')->nullable();
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
