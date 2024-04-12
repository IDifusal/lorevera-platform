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
        Schema::create('circumferences', function (Blueprint $table) {
            $table->id();
            $table->string('value');  // Stores the value as a string
            $table->string('type');   // Stores the type of circumference
            $table->unsignedBigInteger('user_id');  // Foreign key to the users table

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  // Foreign key constraint

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('circumferences');
    }
};
