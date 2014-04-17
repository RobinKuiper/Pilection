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
			$table->string('email');
			$table->string('username');
			$table->string('firstname');
			$table->string('lastname');
			$table->string('profile_url');
			$table->string('website_url');
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
