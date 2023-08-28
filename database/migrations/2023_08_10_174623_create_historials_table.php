<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historials', function (Blueprint $table) {
            $table->id('idhistorial');
            $table->string('tit_diagnostico')->nullable();
            $table->string('text_diagnostico')->nullable();
            $table->float('pago_adelanto',8, 2)->nullable();
            $table->json('h_odontograma')->nullable();
            $table->integer('idtratamiento');
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
        Schema::dropIfExists('historials');
    }
}
