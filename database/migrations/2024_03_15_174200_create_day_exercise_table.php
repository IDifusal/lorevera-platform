<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('day_exercise', function (Blueprint $table) {
            $table->id();
            $table->foreignId('day_id')->constrained('days')->onDelete('cascade');
            // Use the correct singular table name 'exercise' here
            $table->foreignId('exercise_id')->constrained('exercise')->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('day_exercise');
    }
};
