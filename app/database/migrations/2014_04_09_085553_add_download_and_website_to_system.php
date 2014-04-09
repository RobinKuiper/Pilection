<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDownloadAndWebsiteToSystem extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('systems', function(Blueprint $table)
		{
			$table->string('download')->after('image');
                        $table->string('website')->after('download');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('systems', function(Blueprint $table)
		{
			$table->dropColumn('download');
                        $table->dropColumn('website');
		});
	}

}