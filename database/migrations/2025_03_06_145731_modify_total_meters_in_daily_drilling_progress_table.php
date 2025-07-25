<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('daily_drilling_progress', function (Blueprint $table) {
            // First drop the total_meters column
            $table->dropColumn('total_meters');
        });

        Schema::table('daily_drilling_progress', function (Blueprint $table) {
            // Then recreate it as a computed column
            $table->decimal('total_meters', 10, 2)->storedAs('drills_count * meters_per_drill');
        });
    }

    public function down()
    {
        Schema::table('daily_drilling_progress', function (Blueprint $table) {
            // First drop the computed column
            $table->dropColumn('total_meters');
        });

        Schema::table('daily_drilling_progress', function (Blueprint $table) {
            // Then recreate it as a regular column
            $table->decimal('total_meters', 10, 2);
        });
    }
};
