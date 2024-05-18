<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');

        Schema::dropIfExists('customers');
        Schema::dropIfExists('pets');
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('customer_id');
            $table->dropColumn('pet_id');
        });

        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
