<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeseadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deseados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('turnoDeseado');
        
            $table->integer('planilla_turno_user_id')->unsigned();
            $table->foreign('planilla_turno_user_id')->references('id')->on('planilla_turno_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('deseados');
    }
}
