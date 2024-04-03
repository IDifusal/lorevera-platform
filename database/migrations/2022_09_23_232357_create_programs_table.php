<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgramsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('subtitle')->nullable();
            $table->string('tag')->nullable();

            $table->decimal('price', 10, 2);
            $table->string('featured_image')->nullable();
            
            $table->boolean('is_public')->default(false);
            $table->boolean('has_access')->default(true);

            $table->string('focus_image_url')->nullable();
            $table->string('based_image_url')->nullable();
            
            $table->string('duration_per_workout');
            $table->string('duration_per_week');
            $table->string('focus');
            $table->string('based');
            $table->text('overview')->nullable(); 
            $table->text('introduction')->nullable(); 
                       
            $table->integer('delete')->default(0);
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
        Schema::dropIfExists('programs');
    }
}
