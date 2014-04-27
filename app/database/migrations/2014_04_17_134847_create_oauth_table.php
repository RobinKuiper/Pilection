<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOauthTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('oauth', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('user_id');
			$table->string('provider');
			$table->string('provider_uid');
			$table->string('email')->nullable();
			$table->string('username');
			$table->string('firstname')->nullable();
			$table->string('lastname')->nullable();
			$table->string('profile_url')->nullable();
			$table->string('website_url')->nullable();
            $table->string('photo_url')->nullable();
            $table->text('description')->nullable();
            $table->string('gender')->nullable();
            $table->string('language')->nullable();
            $table->integer('age')->nullable();
            $table->string('birthday')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('country')->nullable();
            $table->string('region')->nullable();
            $table->string('city')->nullable();
            $table->string('zip')->nullable();
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
		Schema::drop('oauth');
	}

}
