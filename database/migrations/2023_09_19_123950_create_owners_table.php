<?php

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
        Schema::create('owners', function (Blueprint $table) {
            $table->id();
            // Will be removed after data mirgation
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('name', 100);
            $table->string('phone', 50);
            $table->string('secondary_phone', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('address', 255)->nullable();
            $table->integer('zip_code')->nullable();
            $table->string('city', 100)->nullable();
            $table->boolean('has_reminder')->default(false);
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
        Schema::dropIfExists('owners');
    }
};
