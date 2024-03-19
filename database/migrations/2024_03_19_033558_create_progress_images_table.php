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
        Schema::create('progress_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('type'); // For storing the body part type like arm, legs, etc.
            $table->string('image_url'); // The URL/path to the stored image
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('progress_images');
    }
};
