<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('daily_drilling_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->integer('drills_count');
            $table->decimal('meters_per_drill', 10, 2);
            $table->decimal('total_meters', 10, 2)->storedAs('drills_count * meters_per_drill');
            $table->text('details')->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('daily_drilling_progress');
    }
};
