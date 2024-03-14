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
        Schema::table('users', function (Blueprint $table) {
            // Change height and weight to decimal with precision of 10 and scale of 4
            $table->decimal('height', 10, 4)->nullable()->change();
            $table->decimal('weight', 10, 4)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Optionally, revert back to float if necessary
            $table->float('height')->nullable()->change();
            $table->float('weight')->nullable()->change();
        });
    }
};
