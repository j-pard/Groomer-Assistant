<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBreedsToPetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pets', function (Blueprint $table) {
            $table->unsignedBigInteger('main_breed_id')->nullable()->after('genre');
            $table->foreign('main_breed_id')->references('id')->on('breeds');

            $table->unsignedBigInteger('second_breed_id')->nullable()->after('main_breed_id');
            $table->foreign('second_breed_id')->references('id')->on('breeds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pets', function (Blueprint $table) {
            //
        });
    }
}
