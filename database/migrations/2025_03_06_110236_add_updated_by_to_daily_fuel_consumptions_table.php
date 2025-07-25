<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('daily_fuel_consumptions', function (Blueprint $table) {
            if (!Schema::hasColumn('daily_fuel_consumptions', 'updated_by')) {
                $table->foreignId('updated_by')->constrained('users')->after('created_by');
            }
        });
    }

    public function down()
    {
        Schema::table('daily_fuel_consumptions', function (Blueprint $table) {
            $table->dropForeign(['updated_by']);
            $table->dropColumn('updated_by');
        });
    }
};
