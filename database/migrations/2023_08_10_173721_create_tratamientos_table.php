<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTratamientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tratamientos', function (Blueprint $table) {
            $table->id('idtratamientos');
            $table->integer('idpaciente')->nullable();
            $table->text('titulo_tratamiento')->nullable();
            $table->text('diagnostico')->nullable();
            $table->float('costo_total', 8, 2)->nullable();
            $table->float('adelanto', 8, 2)->nullable();
            $table->json('data_odontograma')->nullable();
            $table->integer('finalizar_tratamiento')->default(0);
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
        Schema::dropIfExists('tratamientos');
    }
}
