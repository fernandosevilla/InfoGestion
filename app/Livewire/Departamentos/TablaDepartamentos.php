<?php

namespace App\Livewire\Departamentos;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Departamento;

/**
 * Clase del componente de la tabla de departamentos que gestiona la visualización,
 * creación, edición y eliminación de departamentos con paginación.
 *
 * @package App\Livewire\Departamentos
 * @author Fernando Sevilla
 * @version 1.0
 */
class TablaDepartamentos extends Component
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

    // ---------------------------------------------------------------------
    // Propiedades para el modal de creación / edición
    // ---------------------------------------------------------------------
    public bool $mostrarModal = false;
    public ?int $idAEditar = null;   // null = crear, distinto = editar
    public string $nombre = '';

    /**
     * Obtiene los departamentos paginados y devuelve la vista.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function render()
    {
        $departamentos = Departamento::orderBy('created_at', 'desc')
            ->paginate($this->numPorPagina);

        return view('livewire.departamentos.tabla-departamentos', compact('departamentos'));
    }


    // ---------------------------------------------------------------------
    // Funciones para el modal de eliminación
    // ---------------------------------------------------------------------

    /**
     * Abre el modal de eliminación.
     *
     * @param int $id ID del departamento a eliminar
     * @return void
     */
    public function confirmarEliminar(int $id)
    {
        $this->idAEliminar = $id;
        $this->mostrarModalBorrar = true;
    }

    /**
     * Elimina el departamento seleccionado.
     *
     * @return void
     */
    public function eliminar()
    {
        Departamento::destroy($this->idAEliminar);
        $this->mostrarModalBorrar = false;
        $this->idAEliminar = null;

        $this->resetPage();

        session()->flash('toast', [
            'name'=>'warning',
            'message'=>'Departamento eliminado.'
        ]);
    }

    // ---------------------------------------------------------------------
    // Funciones para el modal de creación / edición
    // ---------------------------------------------------------------------

    /**
     * Abre el modal de creación / edición.
     *
     * @param int|null $id ID del departamento a editar (null = crear)
     * @return void
     */
    public function abrirModal(?int $id = null)
    {
        // si llaman sin parámetro creamos, si no editamos
        $this->idAEditar = $id;

        $this->nombre = $id
            ? Departamento::findOrFail($id)->nombre
            : '';

        $this->mostrarModal = true;
    }

    /**
     * Guarda el departamento.
     *
     * @return void
     */
    public function guardar()
    {
        $rules = ['nombre' => 'required|string|max:255|unique:departamentos,nombre'];
        if ($this->idAEditar) {
            // excepto el propio registro
            $rules['nombre'] .= ',' . $this->idAEditar;
        }

        $this->validate($rules);

        if ($this->idAEditar) {
            Departamento::find($this->idAEditar)->update(['nombre' => $this->nombre]);

            session()->flash('toast', [
                'name'=>'success',
                'message'=>'Departamento actualizado.'
            ]);
        } else {
            Departamento::create(['nombre' => $this->nombre]);
            session()->flash('toast', [
                'name'=>'success',
                'message'=>'Departamento creado.'
            ]);
        }

        $this->mostrarModal = false;
        $this->idAEditar = null;

        $this->resetPage();
    }
}
