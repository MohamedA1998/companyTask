<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // drop
            $table->dropColumn('name');
            $table->dropColumn('email');
            $table->dropColumn('email_verified_at');

            // create 
            $table->string('username');
            $table->string('phone')->unique();
            $table->mediumInteger('phone_verfiy_code');
            $table->timestamp('phone_verified_at')->nullable();
            $table->string('fcm_token')->nullable();
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
            // drop
            $table->dropColumn('username');
            $table->dropColumn('phone');
            $table->dropColumn('phone_verfiy_code');
            $table->dropColumn('phone_verified_at');
            $table->dropColumn('fcm_token');

            // create 
            $table->string('name');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
        });
    }
};
