<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBolsasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bolsas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cantidad');
            $table->integer('tamano');
            $table->timestamps();

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
        Schema::drop('bolsas');
    }
}
