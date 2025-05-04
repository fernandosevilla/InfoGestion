<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecutamos el seeder de roles y permisos
        $this->call(RolesAndPermissionsSeeder::class);

        // Crear o recuperar usuario administrador
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@infogestion.com'],
            [
                'name'     => 'Administrador',
                'password' => Hash::make('Asd@_1234@_'),
            ]
        );

        if ($adminUser->wasRecentlyCreated) {
            $this->command->info("Usuario administrador creado: {$adminUser->email}");
        } else {
            $this->command->info("Usuario administrador existente: {$adminUser->email}");
        }

        // Asignar rol 'admin' al usuario administrador si no lo tiene
        $adminRole = Role::where('name', 'admin')->first();

        if (!$adminRole) {
            $this->command->error("El rol 'admin' no existe. Revisa RolesAndPermissionsSeeder.");
            return;
        }

        if (!$adminUser->hasRole($adminRole)) {
            $adminUser->assignRole($adminRole);
            $this->command->info("Rol 'admin' asignado a {$adminUser->email}");
        } else {
            $this->command->info("{$adminUser->email} ya tiene el rol 'admin'");
        }
    }
}
