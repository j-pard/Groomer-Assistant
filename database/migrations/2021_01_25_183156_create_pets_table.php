<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pets', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['dog', 'cat'])->default('dog');
            $table->string('name');
            $table->timestamp('birthdate')->nullable();
            $table->enum('status', ['active', 'not going', 'dead'])->default('active');
            $table->integer('average_duration')->nullable();
            $table->json('remarks')->nullable();
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
        Schema::dropIfExists('pets');
    }
}
