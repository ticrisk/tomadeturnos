<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostulacionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postulacion_user', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('postulacion')->nullable();
            $table->enum('estado', ['Espera','Tomado'])->nullable();

            $table->integer('postulacion_id')->unsigned();
            $table->foreign('postulacion_id')->references('id')->on('postulaciones')->onDelete('cascade');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('postulacion_user');
    }
}
