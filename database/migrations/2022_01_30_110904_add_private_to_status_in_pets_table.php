<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class AddPrivateToStatusInPetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE pets CHANGE COLUMN status status ENUM('active', 'private', 'not-coming', 'dead') NOT NULL DEFAULT 'active'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE pets CHANGE COLUMN status status ENUM('active', 'not-coming', 'dead') NOT NULL DEFAULT 'active'");
    }
}
