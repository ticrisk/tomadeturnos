<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('estado', ['Aceptado', 'Rechazado', 'Pendiente'])->default('Pendiente');
            $table->decimal('pagoTotal', 8,2);
            $table->date('fechaPago');
            $table->date('pagoDesde');
            $table->date('pagoHasta');
            $table->enum('tipoPago', ['Transferencia', 'Depósito', 'Efectivo', 'Pago Online', 'Pagado por otra Persona', 'Costo Cero'])->default('Transferencia');
            $table->string('comprobante', 250)->nullable();;
            $table->text('informacionExtra')->nullable();//max 1000
            $table->enum('paga', ['Empaque', 'Encargado'])->default('Empaque');
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
        Schema::dropIfExists('pagos');
    }
}
