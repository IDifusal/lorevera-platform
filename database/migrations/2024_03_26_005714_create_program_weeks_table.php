<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('program_weeks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_id')->constrained()->onDelete('cascade');
            $table->integer('week_number');
            $table->timestamps();
        });

        // Assuming you already have a 'days' table, now create a pivot table to link days to program_weeks
        Schema::create('program_week_day', function (Blueprint $table) {
            $table->id();
            $table->foreignId('program_week_id')->constrained('program_weeks')->onDelete('cascade');
            $table->foreignId('day_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('program_week_day');
        Schema::dropIfExists('program_weeks');
    }
};
