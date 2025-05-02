<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // PERMISOS
        $permisos = [
            // SOBRE TABLA EMPLEADOS
            'ver-empleados', 'crear-empleados', 'editar-empleados', 'eliminar-empleados',

            // SOBRE TABLA DEPARTAMENTOS
            'ver-departamentos', 'crear-departamentos', 'editar-departamentos', 'eliminar-departamentos',

            // SOBRE TABLA CLIENTES
            'ver-clientes', 'crear-clientes', 'editar-clientes', 'eliminar-clientes',

            // SOBRE TABLA CONTRATOS
            'ver-contratos', 'crear-contratos', 'editar-contratos', 'eliminar-contratos',

            // SOBRE TABLA INVENTARIOS
            'ver-inventarios', 'crear-inventarios', 'editar-inventarios', 'eliminar-inventarios',

            // SOBRE AVISOS
            'ver-avisos', 'crear-avisos', 'editar-avisos', 'eliminar-avisos',

            // SOBRE PARTES
            'ver-partes', 'crear-partes', 'editar-partes', 'eliminar-partes', 'firmar-partes',

            // SOBRE INTERVENCIONES DE PARTES
            'iniciar-intervencion', 'finalizar-intervencion',

            // SOBRE MATERIALES
            'ver-materiales', 'aniadir-materiales', 'editar-materiales', 'eliminar-materiales',
        ];

        foreach ($permisos as $permiso) {
            // Verificar si el permiso ya existe
            if (!Permission::where('name', $permiso)->exists()) {
                Permission::create(['name' => $permiso]);
            }
        }

        // ROLES
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $administracion = Role::firstOrCreate(['name' => 'administracion']);
        $empleado = Role::firstOrCreate(['name' => 'empleado']);

        // ASIGNAR TODOS LOS PERMISOS A ADMIN Y A ADMINISTRACION
        $admin->syncPermissions(Permission::all());
        $administracion->syncPermissions(Permission::all());

        // PERMISOS ESPECIFICOS PARA LOS EMPLEADOS
        $permisos_empleados = [
            'ver-empleados',
            'ver-clientes',
            'ver-contratos',
            'ver-inventarios', 'editar-inventarios',
            'ver-avisos', 'crear-avisos', 'editar-avisos', 'eliminar-avisos',
            'ver-partes', 'crear-partes', 'editar-partes', 'eliminar-partes', 'firmar-partes',
            'iniciar-intervencion', 'finalizar-intervencion',
            'ver-materiales', 'aniadir-materiales', 'editar-materiales', 'eliminar-materiales',
        ];

        $empleado->syncPermissions($permisos_empleados);
    }
}
