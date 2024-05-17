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
        Schema::table('scheduled_notifications', function (Blueprint $table) {
            $table->dropColumn('message');  // Remove the 'message' column
            $table->string('status');       // Add a 'status' column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('scheduled_notifications', function (Blueprint $table) {
            $table->text('message');        // Re-add the 'message' column
            $table->dropColumn('status');   // Remove the 'status' column
        });
    }
};
