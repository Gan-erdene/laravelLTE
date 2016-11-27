<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('work_images', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('work_id');
          $table->integer('user_id');
          $table->string('extention');
          $table->string('image_name');
          $table->integer('timestamp');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
