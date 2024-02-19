<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAddressBirthdayHeightWeightGenderToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('address')->nullable();
            $table->string('birthdayDate')->nullable();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->string('gender')->nullable();
            $table->string('imageURL')->nullable();            
            $table->string('location')->nullable();                  
            $table->string('age')->nullable();                 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('birthdayDate');
            $table->dropColumn('height');
            $table->dropColumn('weight');
            $table->dropColumn('gender');
        });
    }
}
