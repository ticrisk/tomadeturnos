<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('local_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedTinyInteger('cuposToma')->default(4);//admite de 0 a 255
            $table->unsignedTinyInteger('cuposPreToma')->default(0);//Si es 0 no puede ingresar a la PreToma
            $table->unsignedTinyInteger('cuposRepechaje')->default(10);
            //$table->enum('preToma', ['Si', 'No'])->default('No');//Habilitado para la Pre-Toma, no se si sea necesaria esta opción, ya que solo se dejaría en 0 en cuposPreToma aí no pueden tomar turnos en la PreToma.
            $table->enum('estado', ['Activo', 'Desvinculado', 'Suspendido', 'Deudor'])->default('Activo');

            $table->enum('rol', ['Empaque', 'Coordinador', 'Encargado','Supervisor'])->default('Empaque');
            $table->datetime('inicioCastigo')->nullable();
            $table->datetime('terminoCastigo')->nullable();

            $table->integer('local_id')->unsigned();
            $table->foreign('local_id')->references('id')->on('locales')->onDelete('cascade'); 

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
        Schema::drop('local_user');
    }
}
