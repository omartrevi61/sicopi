<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolesAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // USER MODEL
       $userPermission1 = Permission::create(['name' => 'crear_usuario']);
       $userPermission2 = Permission::create(['name' => 'editar_usuario']);
       $userPermission3 = Permission::create(['name' => 'eliminar_usuario']);
       $userPermission4 = Permission::create(['name' => 'consultar_usuario']);

       // ROLE MODEL
       $rolePermission1 = Permission::create(['name' => 'crear_role']);
       $rolePermission2 = Permission::create(['name' => 'editar_role']);
       $rolePermission3 = Permission::create(['name' => 'eliminar_role']);
       $rolePermission4 = Permission::create(['name' => 'consultar_role']);

       // PERMISSION MODEL
       $permission1 = Permission::create(['name' => 'crear_permiso']);
       $permission2 = Permission::create(['name' => 'editar_permiso']);
       $permission3 = Permission::create(['name' => 'eliminar_permiso']);
       $permission4 = Permission::create(['name' => 'consultar_permiso']);

       // Centro MODEL
       $centroPermission1 = Permission::create(['name' => 'crear_centro']);
       $centroPermission2 = Permission::create(['name' => 'editar_centro']);
       $centroPermission3 = Permission::create(['name' => 'eliminar_centro']);
       $centroPermission4 = Permission::create(['name' => 'consultar_centro']);

       // Ubpp MODEL
       $ubppPermission1 = Permission::create(['name' => 'crear_ubpp']);
       $ubppPermission2 = Permission::create(['name' => 'editar_ubpp']);
       $ubppPermission3 = Permission::create(['name' => 'eliminar_ubpp']);
       $ubppPermission4 = Permission::create(['name' => 'consultar_ubpp']);

       // Tipos de proyecto MODEL
       $tipoProyectoPermission1 = Permission::create(['name' => 'crear_tipoProyecto']);
       $tipoProyectoPermission2 = Permission::create(['name' => 'editar_tipoProyecto']);
       $tipoProyectoPermission3 = Permission::create(['name' => 'eliminar_tipoProyecto']);
       $tipoProyectoPermission4 = Permission::create(['name' => 'consultar_tipoProyecto']);

       // Profesor MODEL
       $profesorPermission1 = Permission::create(['name' => 'crear_profesor']);
       $profesorPermission2 = Permission::create(['name' => 'editar_profesor']);
       $profesorPermission3 = Permission::create(['name' => 'eliminar_profesor']);
       $profesorPermission4 = Permission::create(['name' => 'consultar_profesor']);

       // Proyecto MODEL
       $proyectoPermission1 = Permission::create(['name' => 'crear_proyecto']);
       $proyectoPermission2 = Permission::create(['name' => 'editar_proyecto']);
       $proyectoPermission3 = Permission::create(['name' => 'eliminar_proyecto']);
       $proyectoPermission4 = Permission::create(['name' => 'consultar_proyecto']);

       // Provedor MODEL
       $provedorPermission1 = Permission::create(['name' => 'crear_provedor']);
       $provedorPermission2 = Permission::create(['name' => 'editar_provedor']);
       $provedorPermission3 = Permission::create(['name' => 'eliminar_provedor']);
       $provedorPermission4 = Permission::create(['name' => 'consultar_provedor']);

       // Tipo de Pago MODEL
       $tipoPagoPermission1 = Permission::create(['name' => 'crear_tipoPago']);
       $tipoPagoPermission2 = Permission::create(['name' => 'editar_tipoPago']);
       $tipoPagoPermission3 = Permission::create(['name' => 'eliminar_tipoPago']);
       $tipoPagoPermission4 = Permission::create(['name' => 'consultar_tipoPago']);

       // Recibo (contraRecibos) MODEL
       $reciboPermission1 = Permission::create(['name' => 'crear_contrarecibo']);
       $reciboPermission2 = Permission::create(['name' => 'editar_contrarecibo']);
       $reciboPermission3 = Permission::create(['name' => 'eliminar_contrarecibo']);
       $reciboPermission4 = Permission::create(['name' => 'consultar_contrarecibo']);

       $superAdminRole = Role::create(['name' => 'Administrador'])->syncPermissions([
           $userPermission1,
           $userPermission2,
           $userPermission3,
           $userPermission4,
           $rolePermission1,
           $rolePermission2,
           $rolePermission3,
           $rolePermission4,
           $permission1,
           $permission2,
           $permission3,
           $permission4,

           $centroPermission1,
           $centroPermission2,
           $centroPermission3,
           $centroPermission4,

           $ubppPermission1,
           $ubppPermission2,
           $ubppPermission3,
           $ubppPermission4,

           $tipoProyectoPermission1,
           $tipoProyectoPermission2,
           $tipoProyectoPermission3,
           $tipoProyectoPermission4,

           $profesorPermission1,
           $profesorPermission2,
           $profesorPermission3,
           $profesorPermission4,

           $proyectoPermission1,
           $proyectoPermission2,
           $proyectoPermission3,
           $proyectoPermission4,

           $provedorPermission1,
           $provedorPermission2,
           $provedorPermission3,
           $provedorPermission4,

           $tipoPagoPermission1,
           $tipoPagoPermission2,
           $tipoPagoPermission3,
           $tipoPagoPermission4,

           $reciboPermission1,
           $reciboPermission2,
           $reciboPermission3,
           $reciboPermission4,
       ]);

       $operadorRole = Role::create(['name' => 'Operador'])->syncPermissions([
        $centroPermission1,
        $centroPermission2,
        $centroPermission4,

        $ubppPermission1,
        $ubppPermission2,
        $ubppPermission4,

        $tipoProyectoPermission1,
        $tipoProyectoPermission2,
        $tipoProyectoPermission4,

        $profesorPermission1,
        $profesorPermission2,
        $profesorPermission4,

        $proyectoPermission1,
        $proyectoPermission2,
        $proyectoPermission4,

        $provedorPermission1,
        $provedorPermission2,
        $provedorPermission4,

        $tipoPagoPermission1,
        $tipoPagoPermission2,
        $tipoPagoPermission4,

        $reciboPermission1,
        $reciboPermission2,
        $reciboPermission4,
       ]);

       $profesorRole = Role::create(['name' => 'Profesor'])->syncPermissions([
        $proyectoPermission4,
        $reciboPermission4,
       ]);

       // CREATE USERS
       User::create([
           'name' => 'Omar Treviño',
           'email' => 'omar-trevino@hotmail.com',
           'email_verified_at' => now(),
           'password' => Hash::make('password'),
           'remember_token' => Str::random(10),
       ])->assignRole($superAdminRole);
    }
}
