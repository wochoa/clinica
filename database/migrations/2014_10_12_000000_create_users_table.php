<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            
             
            // ---------------
            $table->id();
			$table->string('nacionalidad')->nullable();
			$table->enum('tipo_doc', ['DNI', 'PASAPORTE'])->default('DNI');
			$table->string('num_doc')->nullable();// numero doc
			$table->string('ap_paterno')->nullable();
			$table->string('ap_materno')->nullable();
			$table->longText('foto')->nullable();
			$table->string('nombre');
			$table->string('lugar_nac')->nullable();
			$table->string('sexo')->nullable();
			$table->date('fecha_nac')->nullable();
			$table->string('estadocivil')->nullable();
			$table->integer('dom_deparatmento')->nullable();
			$table->integer('dom_provincia')->nullable();
			$table->integer('dom_distrito')->nullable();
			$table->string('tipo_zona')->nullable();
			$table->string('nom_zona')->nullable();
			$table->string('via')->nullable();
			$table->string('direccion')->nullable();
			$table->string('telefono')->nullable();
			$table->string('celular')->nullable();
			$table->string('email')->unique();
			$table->string('colegio_prof')->nullable();
			$table->string('num_colegio')->nullable();
			$table->string('discapcidad')->default('NO');
			$table->string('fuerza_arm')->nullable();
			$table->string('ubigeo')->nullable();
            $table->string('password');
            $table->rememberToken();			
			$table->integer('adm_primer_logeo')->nullable();
			$table->text('avatar')->default('avatar/logo.png');
			$table->string('darkmode')->nullable();
			$table->timestamp('email_verified_at')->nullable();
			
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
        Schema::dropIfExists('users');
    }
}
