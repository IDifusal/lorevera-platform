<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bundles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('subtitle')->nullable();
            $table->decimal('normal_price', 10, 2);
            $table->decimal('sale_price', 10, 2)->nullable();
            $table->timestamps();
        });

        // Pivot table for bundle-program relationship
        Schema::create('bundle_program', function (Blueprint $table) {
            $table->foreignId('bundle_id')->constrained('bundles')->onDelete('cascade');
            $table->foreignId('program_id')->constrained('programs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bundle_program');
        Schema::dropIfExists('bundles');
    }
};
