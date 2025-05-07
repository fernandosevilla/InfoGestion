<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

/**
 * Componente Livewire que gestiona la tabla de roles,
 * proporcionando funcionalidades de listado, búsqueda,
 * paginación, creación, edición y eliminación de roles.
 *
 * @package App\Livewire\Roles
 * @author Fernando Sevilla
 * @version 1.0
 */
class TablaRoles extends Component
{
    use WithPagination;

    // tema de paginación (tailwind modificado)
    protected $paginationTheme = 'tailwind';

    public int $numPorPagina = 5;

    // ---------------------------------------------------------------------
    // Propiedades para el modal de eliminación
    // ---------------------------------------------------------------------
    public bool $mostrarModalBorrar = false;
    public ?int $idAEliminar = null;


    /**
     * Renderiza la vista con los roles.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $roles = Role::orderBy('name', 'asc')
            ->paginate($this->numPorPagina);

        return view('livewire.roles.tabla-roles', compact('roles'));
    }

    // ----------------------------------------
    // Métodos CRUD
    // ----------------------------------------

    /**
     * Abre el modal de confirmación para eliminar un rol.
     *
     * @param int $id ID del rol a eliminar
     * @return void
     */
    public function confirmarEliminar(int $id)
    {
        $this->idAEliminar = $id;
        $this->mostrarModalBorrar = true;
    }

    /**
     * Elimina el rol seleccionado y muestra un toast de confirmación.
     *
     * @return void
     */
    public function eliminar()
    {
        Role::findOrFail($this->idAEliminar)->delete();

        session()->flash('toast', [
            'name'    => 'warning',
            'message' => 'Rol eliminado correctamente.',
        ]);

        $this->mostrarModalBorrar = false;
        $this->idAEliminar = null;
    }
}
