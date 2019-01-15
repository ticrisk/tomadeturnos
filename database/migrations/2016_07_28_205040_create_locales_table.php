<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('locales', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre', 45);
            $table->enum('cuenta', ['Free','Premium'])->default('Free');
            $table->enum('estado', ['Activo','Bloqueado'])->default('Activo');
            $table->string('direccion', 45)->nullable();
            $table->char('codigo', 16)->nullable();
            $table->char('codigoPostulacion', 16)->nullable();

            //Opciones de Configuración
            $table->enum('planillaEmpaque', ['No','Si'])->default('No');
            $table->enum('planillaCoordinador', ['No','Si'])->default('Si');
            $table->enum('cambiar', ['No','Si'])->default('No');
            $table->unsignedTinyInteger('cambiarHasta')->default(0);
            $table->enum('ceder', ['No','Si'])->default('No');
            $table->enum('regalarLocal', ['No','Si'])->default('Si');
            $table->enum('preToma', ['No','Si'])->default('No');
            $table->enum('repechajeLocal', ['No','Si'])->default('Si');


            $table->enum('visible', ['No','Si'])->default('Si');
            $table->decimal('precioMensual', 8,2);
            $table->enum('responsablePago', ['Encargado','Empaques'])->default('Encargado');
            //Fin Opciones de Configuración

            $table->integer('cadena_id')->unsigned();
            $table->foreign('cadena_id')->references('id')->on('cadenas')->onDelete('cascade');

            $table->integer('organizacion_id')->unsigned();
            $table->foreign('organizacion_id')->references('id')->on('organizaciones')->onDelete('cascade');                        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('locales');
    }
}
