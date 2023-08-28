<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id('idcitas');
            $table->integer('idpaciente')->nullable();
            $table->integer('iduser');
            $table->integer('idservicio')->nullable();
            $table->enum('tipo_cita', ['PRIMERA VEZ', 'SEGUIMIENTO','OTROS'])->default('PRIMERA VEZ');
            $table->date('fecha_inicial')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->time('hora_inicial')->nullable();
            $table->time('hora_fin')->nullable();
            $table->string('titulo_evento')->nullable();
            $table->string('color')->nullable();
            $table->integer('atendido')->default(0)->nullable();

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
        Schema::dropIfExists('citas');
    }
}
