<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticulosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articulos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('link', 100)->unique();//add-after
            $table->string('titulo', 200);
            $table->string('descripcion', 2000);
            $table->text('texto');
            $table->text('texto2');
            $table->string('portada');
            $table->string('imgDescripcion');
            $table->enum('estado', ['Activo', 'Editando'])->default('Editando');//add-after
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
        Schema::drop('articulos');
    }
}
