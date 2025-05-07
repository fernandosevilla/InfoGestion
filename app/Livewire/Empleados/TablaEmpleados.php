<?php

namespace App\Livewire\Empleados;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Departamento;
use Spatie\Permission\Models\Role;

/**
 * Componente Livewire que gestiona la tabla de empleados,
 * proporcionando funcionalidades de listado, búsqueda,
 * paginación, creación, edición y eliminación de usuarios,
 * así como asignación de roles y departamentos.
 *
 * @package App\Livewire\Empleados
 * @author Fernando Sevilla
 * @version 1.0
 */
class TablaEmpleados extends Component
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
    public ?int $idAEditar = null;
    public string $nombre = '';
    public ?string $email = null;
    public ?string $telefono = null;
    public ?string $extension = null;
    public ?string $password = null;
    public ?int $departamento_id = null;
    public ?string $rol = null;

    /**
     * Define las reglas de validación para los campos.
     *
     * @return array<string, mixed>
     */
    protected function rules()
    {
        $uniqueEmailRule = 'unique:users,email' . ($this->idAEditar ? ',' . $this->idAEditar : '');

        return [
            'nombre'          => 'required|string|max:255',
            'email'           => ['required', 'email', 'max:255', $uniqueEmailRule],
            'telefono'        => 'nullable|string|max:20',
            'extension'       => 'nullable|string|max:10',
            'password'        => 'required|string|min:8',
            'departamento_id' => 'nullable|exists:departamentos,id',
            'rol'             => 'required|exists:roles,name',
        ];
    }

    /**
     * Atributos personalizados para mensajes de error.
     *
     * @return array<string, string>
     */
    protected $validationAttributes = [
        'nombre'          => 'nombre',
        'email'           => 'email',
        'telefono'        => 'teléfono',
        'extension'       => 'extensión',
        'password'        => 'contraseña',
        'departamento_id' => 'departamento',
        'rol'             => 'rol',
    ];

    /**
     * Renderiza la vista con datos de empleados, departamentos y roles.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $empleados = User::with('departamento')
            ->orderBy('name', 'asc')
            ->paginate($this->numPorPagina);

        $departamentos = Departamento::orderBy('nombre')->get();
        $roles = Role::orderBy('name')->get();

        return view('livewire.empleados.tabla-empleados', compact('empleados', 'departamentos', 'roles'));
    }

    // ----------------------------------------
    // Métodos CRUD
    // ----------------------------------------

    /**
     * Abre el modal para crear un nuevo empleado.
     * Resetea el formulario y prepara para creación.
     *
     * @return void
     */
    public function abrirModal()
    {
        $this->resetForm();
        $this->idAEditar = null;
        $this->mostrarModal = true;
    }

    /**
     * Cierra el modal de crear / editar y resetea el formulario.
     *
     * @return void
     */
    public function cerrarModal()
    {
        $this->mostrarModal   = false;
        $this->idAEditar      = null;
        $this->resetForm();    // ya resetea nombre, email, etc. y validaciones
    }

    /**
     * Carga los datos de un empleado existente para editar.
     *
     * @param int $id ID del empleado a editar
     * @return void
     */
    public function editar(int $id)
    {
        $user = User::findOrFail($id);
        $this->idAEditar        = $id;
        $this->nombre           = $user->name;
        $this->email            = $user->email;
        $this->telefono         = $user->telefono;
        $this->extension        = $user->extension;
        $this->departamento_id  = $user->departamento_id;
        $this->rol              = $user->getRoleNames()->first();
        $this->mostrarModal     = true;
    }

    /**
     * Valida y guarda la información de creación o edición.
     * Sincroniza el rol asignado y muestra el toast.
     *
     * @return void
     */
    public function guardar()
    {
        $this->validate();

        // Datos comunes
        $data = [
            'name'            => $this->nombre,
            'email'           => $this->email,
            'telefono'        => $this->telefono,
            'extension'       => $this->extension,
            'departamento_id' => $this->departamento_id,
        ];

        if (!empty($this->password)) {
            $data['password'] = bcrypt($this->password);
        }

        if ($this->idAEditar) {
            $user = User::findOrFail($this->idAEditar);
            $user->update($data);
        } else {
            $user = User::create($data);
        }

        $user->syncRoles($this->rol);

        session()->flash('toast', [
            'name'    => 'success',
            'message' => 'El empleado ' . ($user->name ? ' ha sido actualizado.' : 'creado.'),
        ]);

        $this->cerrarModal();
    }

    /**
     * Muestra el modal de confirmación para eliminar un empleado.
     *
     * @param int $id ID del empleado a eliminar
     * @return void
     */
    public function confirmarEliminar(int $id)
    {
        $this->idAEliminar = $id;
        $this->mostrarModalBorrar = true;
    }

    /**
     * Elimina el empleado seleccionado y muestra un toast de confirmación.
     *
     * @return void
     */
    public function eliminar()
    {
        User::findOrFail($this->idAEliminar)->delete();

        session()->flash('toast', [
            'name'    => '¡Eliminado!',
            'message' => 'Empleado eliminado correctamente.',
        ]);

        $this->mostrarModalBorrar = false;
        $this->idAEliminar = null;
    }

    // ----------------------------------------
    // Helpers
    // ----------------------------------------

    /**
     * Resetea los campos del formulario y las validaciones.
     *
     * @return void
     */
    private function resetForm()
    {
        $this->reset(['nombre', 'email', 'telefono', 'extension', 'departamento_id', 'password', 'rol']);
        $this->resetValidation();
    }

    /**
     * Obtenemos todos los departamentos ordenador por nombre.
     *
     * @return \Illuminate\Database\Eloquent\Collection|Departamento[]
     */
    public function getDepartamentosProperty()
    {
        return Departamento::orderBy('nombre')->get();
    }
}
