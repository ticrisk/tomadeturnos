<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTurnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('turnos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->time('inicio');
            $table->time('termino');
            $table->integer('cupos');

            $table->integer('planilla_id')->unsigned();
            $table->foreign('planilla_id')->references('id')->on('planillas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('turnos');
    }
}
