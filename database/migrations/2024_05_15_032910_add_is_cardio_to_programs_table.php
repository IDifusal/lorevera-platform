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
        Schema::table('days', function (Blueprint $table) {
            $table->boolean('isCardio')->default(false);
        });
    }

    public function down()
    {
        Schema::table('days', function (Blueprint $table) {
            $table->dropColumn('isCardio');
        });
    }
};
