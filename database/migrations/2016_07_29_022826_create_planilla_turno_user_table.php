<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanillaTurnoUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planilla_turno_user', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('estado', ['Activo', 'Cancelado'])->default('Activo');
            $table->enum('fijo', ['No','Si'])->default('No');
            $table->enum('coordinador', ['No','Si'])->default('No');
            $table->enum('tipo', ['Toma', 'Pre Toma', 'Asignado', 'Repechaje', 'Regalando', 'Regalo', 'Cambiando', 'Cambiado', 'Cediendo', 'Cedido'])->default('Toma');
            $table->enum('exTipo', ['Toma', 'Pre Toma', 'Asignado', 'Repechaje', 'Regalando', 'Regalo', 'Cambiando', 'Cambiado', 'Cediendo', 'Cedido'])->nullable();
            $table->enum('deseo', ['Regalar','Cambiar'])->nullable();
            $table->date('group_change')->nullable();
            $table->timestamps();

            $table->integer('planilla_id')->unsigned();
            $table->foreign('planilla_id')->references('id')->on('planillas')->onDelete('cascade');

            $table->integer('turno_id')->unsigned();
            $table->foreign('turno_id')->references('id')->on('turnos')->onDelete('cascade');
            
            $table->integer('local_user_id')->unsigned();
            $table->foreign('local_user_id')->references('id')->on('local_user')->onDelete('cascade');

            $table->integer('local_user_id')->unsigned();
            $table->foreign('exDueno_id')->references('id')->on('local_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('planilla_turno_user');
    }
}
