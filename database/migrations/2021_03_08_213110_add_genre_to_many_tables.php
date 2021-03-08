<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGenreToManyTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pets', function (Blueprint $table) {
            $table->enum('genre', ['unknown', 'male', 'female'])->default('unknown')->after('name');
        });

        Schema::table('customers', function (Blueprint $table) {
            $table->enum('genre', ['unknown', 'male', 'female'])->default('unknown')->after('lastname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('many_tables', function (Blueprint $table) {
            //
        });
    }
}
