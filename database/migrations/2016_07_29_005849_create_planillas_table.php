<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlanillasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planillas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('inicioPlanilla');
            $table->date('finPlanilla');
            $table->datetime('inicioToma');
            $table->datetime('finToma');
            $table->datetime('inicioRepechaje')->nullable();
            $table->datetime('finRepechaje')->nullable();            
            $table->datetime('inicioPreToma')->nullable();
            $table->datetime('finPreToma')->nullable();
            $table->enum('estado', ['Activa', 'Eliminada'])->default('Activa');

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
        Schema::drop('planillas');
    }
}
