<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

/**
 * Componente Livewire que gestiona el formulario para crear / editar roles.
 * Permite definir el nombre del rol y seleccionar los permisos,
 * tanto los que por defecto están para empleado como para administrador.
 *
 * @package App\Livewire\Roles
 * @author Fernando Sevilla
 * @version 1.0
 */
class FormRol extends Component
{
    public Role $role; // el rol que se está creando o editando
    public $nombre = ''; // nombre del rol
    public $permisosSeleccionados = []; // permisos seleccionados
    public $allPermisos; // todos los permisos

    /**
     * Inicializa el componente con el rol que se está creando o editando.
     *
     * @param Role|null $role
     */
    public function mount(?Role $role) {
        // cargamos todos los permisos ordenados por nombre
        $this->allPermisos = Permission::orderBy('name', 'asc')->get();

        // si se está editando un rol, cargamos sus datos
        if ($role) {
            $this->role = $role;
            $this->nombre = $role->name;
            $this->permisosSeleccionados = $role->permissions->pluck('name')->toArray();
        } else {
            $this->role = new Role();
        }
    }

    /**
     * Valida y guarda el rol, luego sincroniza a este con los permisos seleccionados.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function guardar() {
        $this->role->name = $this->nombre;
        $this->role->save();

        $this->role->syncPermissions($this->permisosSeleccionados);

        session()->flash('toast', [
            'name' => 'success',
            'message' => 'Rol guardado correctamente'
        ]);

        return redirect()->route('roles.index');
    }

    /**
     * Renderiza la vista del formulario.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.roles.form-rol');
    }
}
