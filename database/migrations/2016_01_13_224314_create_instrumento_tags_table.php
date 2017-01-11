<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInstrumentoTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrumento_tags', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('instrumento_id')->unsigned();
            $table->integer('tag_id')->unsigned();

            $table->foreign('instrumento_id')->references('id')->on('instrumentos');
            $table->foreign('tag_id')->references('id')->on('tags');

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
        Schema::drop('instrumento_tags');
    }
}
