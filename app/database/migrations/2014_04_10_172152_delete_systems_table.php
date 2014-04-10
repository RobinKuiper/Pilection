<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class DeleteSystemsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::drop('systems');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::create('systems', function(Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->text('body');
                        $table->string('image')->nullable(true);
                        $table->string('download');
                        $table->string('website');
			$table->timestamps();
                        $table->softDeletes();
		});
	}

}
