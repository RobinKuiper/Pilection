<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddFieldsToOauth extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('oauth', function(Blueprint $table) {
			$table->string('photo_url');
			$table->text('description');
			$table->string('gender');
			$table->string('language');
			$table->integer('age');
			$table->string('birthday');
			$table->string('phone');
			$table->string('address');
			$table->string('country');
			$table->string('region');
			$table->string('city');
			$table->string('zip');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('oauth', function(Blueprint $table) {
			$table->dropColumn('photo_url');
			$table->dropColumn('description');
			$table->dropColumn('gender');
			$table->dropColumn('language');
			$table->dropColumn('age');
			$table->dropColumn('birthday');
			$table->dropColumn('phone');
			$table->dropColumn('address');
			$table->dropColumn('country');
			$table->dropColumn('region');
			$table->dropColumn('city');
			$table->dropColumn('zip');
		});
	}

}
