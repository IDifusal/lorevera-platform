<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatingTableRecipes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes',function (Blueprint $table){
            $table->id();


            $table->enum('plan',['meat_plan','vegetarian_plan'])->default('meat_plan');
            $table->enum('goal',['loss_weight','gain_muscle'])->default('loss_weight');
            $table->string('ingredients')->nullable();

            $table->integer('calories')->default(0);
            $table->integer('fat')->default(0);
            $table->integer('carbs')->default(0);
            $table->integer('protein')->default(0);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
}
