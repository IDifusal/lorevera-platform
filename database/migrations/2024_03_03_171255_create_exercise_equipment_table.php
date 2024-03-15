<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExerciseEquipmentTable extends Migration
{
    public function up()
    {
        // Schema::create('exercise_equipment', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('exercise_id')->constrained()->onDelete('cascade');
        //     $table->foreignId('equipment_id')->constrained()->onDelete('cascade');
        //     $table->timestamps();
        // });
    }

    public function down()
    {
        Schema::dropIfExists('exercise_equipment');
    }
}
