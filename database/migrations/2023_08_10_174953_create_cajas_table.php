<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cajas', function (Blueprint $table) {
            $table->id('idcaja');
            $table->date('fecha')->nullable();
            $table->string('tit_caja')->nullable();
            $table->enum('medio_pago', ['EFECTIVO', 'YAPE','PLIM','VISA','MASTER CARD','DEPOSITO','CHEQUE'])->default('EFECTIVO');
            $table->enum('tipo_caja', ['INGRESO', 'GASTO'])->default('INGRESO');
            $table->float('monto_caja',8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cajas');
    }
}
