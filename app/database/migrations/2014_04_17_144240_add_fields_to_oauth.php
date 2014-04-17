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
