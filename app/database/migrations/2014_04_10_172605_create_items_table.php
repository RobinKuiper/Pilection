<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateItemsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->engine = 'MyISAM';

            $table->increments('id');
            $table->integer('user_id');
            $table->string('title');
            $table->string('slug');
            $table->integer('type_id');
            $table->integer('grade_id');
            $table->text('body');
            $table->string('website_url');
            $table->string('download_url');
            $table->string("image_file_name")->nullable();
            $table->integer("image_file_size")->nullable();
            $table->string("image_content_type")->nullable();
            $table->timestamp("image_updated_at")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::statement('ALTER TABLE `items` ADD FULLTEXT search(title)');
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('items');
    }

}
