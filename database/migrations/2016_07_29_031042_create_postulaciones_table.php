<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostulacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postulaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->text('descripcion');
            $table->integer('cupos');
            $table->datetime('inicio');
            $table->datetime('termino');
            $table->enum('activarLista', ['Privada','Pública', 'Azar'])->default('Privada');
            
            $table->integer('local_id')->unsigned();
            $table->foreign('local_id')->references('id')->on('locales')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('postulaciones');
    }
}
