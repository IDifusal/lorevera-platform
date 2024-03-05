<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddChangeTokenToPasswordResetsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('password_resets', function (Blueprint $table) {
            $table->string('change_token', 64)->nullable()->after('token'); // Assuming tokens are up to 64 characters
            $table->timestamp('token_expires_at')->nullable()->after('change_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('password_resets', function (Blueprint $table) {
            $table->dropColumn(['change_token', 'token_expires_at']);
        });
    }
}
