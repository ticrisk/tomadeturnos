<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaltasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faltas', function (Blueprint $table) {
            $table->increments('id');
            $table->datetime('fecha');
            $table->string('descripcion', 250);
            $table->enum('tipo', ['Leve','Media','Grave'])->default('Leve');
            $table->integer('reportador');
            $table->timestamps();

            $table->integer('local_user_id')->unsigned();
            $table->foreign('local_user_id')->references('id')->on('local_user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('faltas');
    }
}
