<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cardios', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('nameEs')->nullable();
            $table->string('image')->nullable();
            $table->string('category');
            $table->text('instructions');
            $table->text('instructionsEs')->nullable();
            $table->integer('delete')->default(0);
            $table->integer('create_id');
            $table->integer('update_id');
            $table->integer('delete_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cardios');
    }
}
