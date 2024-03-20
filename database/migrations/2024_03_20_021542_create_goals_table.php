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
        Schema::create('goals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to the user
            $table->string('name');
            $table->timestamps(); // created_at will serve as the date of creation
        });
    }

    public function down()
    {
        Schema::dropIfExists('goals');
    }

};
