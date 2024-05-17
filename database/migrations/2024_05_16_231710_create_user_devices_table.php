<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('user_devices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // References the user
            $table->string('fcm_token'); // Stores the Firebase Cloud Messaging token
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key constraint
            $table->index('fcm_token'); // Index for quick lookup
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_devices');
    }
};
