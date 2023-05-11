<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdminToCEOSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('c_e_o_s', function (Blueprint $table) {
            $table->string('email_verified_at');
            $table->string('type');
            $table->string('bot_chat_id');
            $table->string('bot_last_command');
            $table->string('remember_token');
            $table->string('current_team_id');
            $table->string('profile_photo_path');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('c_e_o_s', function (Blueprint $table) {
            //
        });
    }
}
