<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class ServiciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
;
        DB::table('servicios')->insert([ 'nom_servicio'=>'Rayos x']);
        DB::table('servicios')->insert([ 'nom_servicio'=>'Endodoncia']);
        DB::table('servicios')->insert([ 'nom_servicio'=>'Extracciones simples']);
        DB::table('servicios')->insert([ 'nom_servicio'=>'Extracciones compleja']);
        DB::table('servicios')->insert([ 'nom_servicio'=>'Curaciones']);
        DB::table('servicios')->insert([ 'nom_servicio'=>'Limpieza con ultrasonido']);
        DB::table('servicios')->insert([ 'nom_servicio'=>'Protesis fija']);
        DB::table('servicios')->insert([ 'nom_servicio'=>'Protesis removibles']);
        DB::table('servicios')->insert([ 'nom_servicio'=>'Protesis Total']);
        DB::table('servicios')->insert([ 'nom_servicio'=>'Ortodoncia']);
        DB::table('servicios')->insert([ 'nom_servicio'=>'Control Ortodoncia']);
        DB::table('servicios')->insert([ 'nom_servicio'=>'Ortodoncia integral en niños']);
        DB::table('servicios')->insert([ 'nom_servicio'=>'Blanqueamiento dental']);
        DB::table('servicios')->insert([ 'nom_servicio'=>'Fluorización y sellantes']);
    }
}
