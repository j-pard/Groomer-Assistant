<?php

use App\Enums\AppointmentStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->string('status_string')->default(AppointmentStatus::PLANNED)->after('price');
        });

        Schema::table('appointments', function (Blueprint $table) {
            DB::table('appointments')->update(['status_string' => DB::raw('status')]);
            $table->dropColumn('status');
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->renameColumn('status_string', 'status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->enum('status_enum', ['planned','cash','payconiq','bank','private','voucher','not paid','cancelled'])->after('price');
        });

        Schema::table('appointments', function (Blueprint $table) {
            DB::table('appointments')->update(['status_enum' => DB::raw('status')]);
            $table->dropColumn('status');
        });

        Schema::table('appointments', function (Blueprint $table) {
            $table->renameColumn('status_enum', 'status');
        });
    }
};
