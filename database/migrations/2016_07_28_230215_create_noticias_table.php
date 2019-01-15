<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 250);
            $table->text('descripcion');
            $table->enum('estado', ['Oculto', 'Público'])->default('Oculto');
            $table->timestamps();

            $table->integer('local_id')->unsigned();
            $table->foreign('local_id')->references('id')->on('locales')->onDelete('cascade');

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
        Schema::drop('noticias');
    }
}
