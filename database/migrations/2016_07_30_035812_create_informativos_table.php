<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInformativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('informativos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 250);
            $table->text('descripcion');
            $table->enum('estado', ['Privado', 'Público'])->default('Privado');
            $table->enum('tipo', ['Index', 'Locales', 'Encargados', 'Otra'])->default('Otra');
            $table->timestamps();

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
        Schema::drop('informativos');
    }
}
