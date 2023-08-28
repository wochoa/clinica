<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // create permissions
        // CITAS
        Permission::create(['name' => 'citas_index']);
        Permission::create(['name' => 'citas_create']);
        Permission::create(['name' => 'citascli_create']);
        Permission::create(['name' => 'citas_edit']);
        Permission::create(['name' => 'citas_destroy']);
        // PACIENTES
        Permission::create(['name' => 'pacientes_index']);
        Permission::create(['name' => 'pacientes_create']);
        Permission::create(['name' => 'pacientes_edit']);
        Permission::create(['name' => 'pacientes_destroy']);
        //TRATAMIENTOS
        Permission::create(['name' => 'tratamientos_index']);
        Permission::create(['name' => 'tratamientos_create']);
        Permission::create(['name' => 'tratamientos_edit']);
        Permission::create(['name' => 'tratamientos_destroy']);
        //CIRUJANO
        Permission::create(['name' => 'cirujano_index']);
        Permission::create(['name' => 'cirujano_create']);
        Permission::create(['name' => 'cirujano_edit']);
        Permission::create(['name' => 'cirujano_destroy']);
        //GASTOS
        Permission::create(['name' => 'gastos_index']);
        Permission::create(['name' => 'gastos_create']);
        Permission::create(['name' => 'gastos_edit']);
        Permission::create(['name' => 'gastos_destroy']);
        //CAJA
        Permission::create(['name' => 'caja_index']);
        Permission::create(['name' => 'caja_create']);
        Permission::create(['name' => 'caja_edit']);
        Permission::create(['name' => 'caja_destroy']);
        // ADMINISTRACION
        Permission::create(['name' => 'usuario_index']);
        Permission::create(['name' => 'usuario_create']);
        Permission::create(['name' => 'usuario_edit']);
        Permission::create(['name' => 'usuario_destroy']);


        // create roles and assign existing permissions
        $admin = Role::create(['name' => 'Superadmin']);
        $cirujano = Role::create(['name' => 'Cirujano']);
        $paciente = Role::create(['name' => 'Paciente']);

        // asignacion de roles y permisos

        $admin->givePermissionTo(
            [
                'citas_index',
                'citas_create',
                'citascli_create',
                'citas_edit',
                'citas_destroy',
                'pacientes_index',
                'pacientes_create',
                'pacientes_edit',
                'pacientes_destroy',
                'tratamientos_index',
                'tratamientos_create',
                'tratamientos_edit',
                'tratamientos_destroy',
                'cirujano_index',
                'cirujano_create',
                'cirujano_edit',
                'cirujano_destroy',
                'gastos_index',
                'gastos_create',
                'gastos_edit',
                'gastos_destroy',
                'caja_index',
                'caja_create',
                'caja_edit',
                'caja_destroy',
                'usuario_index',
                'usuario_create',
                'usuario_edit',
                'usuario_destroy'
            ]
        );
        $cirujano->givePermissionTo(
            [
                'citas_index',
                'citas_create',
                'citas_edit',
                'citas_destroy',
                'pacientes_index',
                'pacientes_create',
                'pacientes_edit',
                'tratamientos_index',
                'tratamientos_create',
                'tratamientos_edit',
                'tratamientos_destroy',
                'cirujano_index',
                'cirujano_create',
                'cirujano_edit',
                'gastos_index',
                'gastos_create',
                'gastos_edit',
                'gastos_destroy',
                'caja_index',
                'caja_create',
            ]
        );
        $paciente->givePermissionTo(
            [
                'citas_index',
                'citascli_create',
                'tratamientos_index',
                'caja_destroy',
                'usuario_edit'

            ]
        );

       // create a demo user
      $user = \App\Models\User::factory()->create([
        'nombre' => 'WILMER',
        'ap_paterno' => 'OCHOA',
        'ap_materno' => 'ALVARADO',
        'tipo_doc' => 'DNI',
        'num_doc' => '42282733',
        'email' => 'woalvarado1@gmail.com',
        'celular'=>'912963711',
        'fecha_nac'=>'1984-01-28'
          // factory default password is 'password'
      ]);
      $user->assignRole($admin);
    }
}
