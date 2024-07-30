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
        Schema::table('appointments', function (Blueprint $table) {
            $table->unsignedInteger('duration')->nullable()->after('status');
        });

        // Save dog average_duration as appointment duration for all appts. Needed to keep history if modifying average duration
        DB::table('appointments')
            ->join('dogs', 'appointments.dog_id', '=', 'dogs.id')
            ->update(['appointments.duration' => DB::raw('dogs.average_duration')]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropColumn('duration');
        });
    }
};
