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
        $permisos = [
            // CLIENTES
            'ver-clientes', 'crear-clientes', 'editar-clientes', 'eliminar-clientes',

            // ARTICULOS

        ];

        foreach ($permisos as $permiso) {
            Permission::firstOrCreate(['name' => $permiso]);
        }

        // Roles
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $empleado = Role::firstOrCreate(['name' => 'empleado']);

        $admin->givePermissionTo($permisos);

        $empleado->givePermissionTo([
            'ver-clientes',
            'crear-clientes',
            'editar-clientes',
        ]);
    }
}
