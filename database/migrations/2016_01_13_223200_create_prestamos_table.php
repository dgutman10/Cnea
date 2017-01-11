<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrestamosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_presta')->index();
            $table->integer('usuario_recibe')->nullable()->index();
            $table->integer('laboratorio_id')->nullable()->index();
            $table->integer('curso_id')->nullable()->index();
            $table->integer('instrumento_id')->index();
            $table->enum('estado_prestamo',['abierto','terminado']);
            $table->string('mail');
            $table->string('telefono');
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
        Schema::drop('prestamos');
    }
}
