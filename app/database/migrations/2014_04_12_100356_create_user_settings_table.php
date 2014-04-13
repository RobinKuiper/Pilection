<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserSettingsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('show_email');
            $table->integer('show_name');
            $table->integer('show_lastlogin');
            $table->integer('system_notification');
            $table->integer('script_notification');
            $table->integer('project_notification');
            $table->string('date_format');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_settings');
    }

}
