<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutritionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nutrition', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('photo')->nullable();
            $table->integer('delete')->default(0);
            $table->string('items')->nullable();
            $table->integer('create_id');
            $table->integer('update_id');
            $table->integer('delete_id');
        });

        $recipes = array(
            array('id' => '1','name' => 'Meat Plan','photo' => 'https://lorevera.s3.amazonaws.com/test/nutrition.png' ,'delete' => '0','create_id' => '3254327','delete_id' => '3255606','update_id' => '3254329'),
            array('id' => '2','name' => 'Vegetarian Plan','photo' => 'https://lorevera.s3.amazonaws.com/test/nutrition.png','delete' => '0','create_id' => '3254377','delete_id' => '3254377','update_id' => '3829029'),
        );

        foreach ($recipes as $recipe){
            \Illuminate\Support\Facades\DB::table('nutrition')->insert([
                'id' => $recipe['id'],
                'name' => $recipe['name'],
                'photo' => $recipe['photo'],
                'delete' => $recipe['delete'],
                'create_id' => 1,
                'update_id' => 1,
                'delete_id' => 1,
            ]);
        }        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nutrition');
    }
}
