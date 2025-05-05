<?php

namespace App\Livewire\Empleados;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\Departamento;

class TablaEmpleados extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';

    public int $numPorPagina = 5;

    // Para la tabla
    public bool $mostrarModal = false;
    public bool $mostrarModalBorrar = false;
    public ?int $idAEditar = null;
    public ?int $idAEliminar = null;

    // Campos del formulario
    public string $nombre = '';
    public ?string $email = null;
    public ?string $telefono = null;
    public ?string $extension = null;
    public ?string $password = null;
    public ?int $departamento_id = null;

    protected function rules()
    {
        $uniqueEmailRule = 'unique:users,email';
        if ($this->idAEditar) {
            $uniqueEmailRule .= ',' . $this->idAEditar;
        }

        return [
            'nombre'          => 'required|string|max:255',
            'email'           => ['required','email','max:255', $uniqueEmailRule],
            'telefono'        => 'nullable|string|max:20',
            'extension'       => 'nullable|string|max:10',
            'password'        => 'required|string|min:8',
            'departamento_id' => 'nullable|exists:departamentos,id',
        ];
    }

    protected $validationAttributes = [
        'nombre'          => 'nombre',
        'email'           => 'email',
        'telefono'        => 'teléfono',
        'extension'       => 'extensión',
        'password'        => 'contraseña',
        'departamento_id' => 'departamento',
    ];

    public function render()
    {
        $empleados = User::with('departamento')
            ->orderBy('name', 'asc')
            ->paginate($this->numPorPagina);

        $departamentos = Departamento::orderBy('nombre')->get();

        return view('livewire.empleados.tabla-empleados', compact('empleados', 'departamentos'));
    }

    // ----------------------------------------
    // Métodos CRUD
    // ----------------------------------------

    public function abrirModal()
    {
        $this->resetForm();
        $this->idAEditar = null;
        $this->mostrarModal = true;
    }

    public function cerrarModal()
    {
        $this->mostrarModal   = false;
        $this->idAEditar      = null;
        $this->resetForm();    // ya resetea nombre, email, etc. y validaciones
    }

    public function editar(int $id)
    {
        $user = User::findOrFail($id);
        $this->idAEditar        = $id;
        $this->nombre           = $user->name;
        $this->email            = $user->email;
        $this->telefono         = $user->telefono;
        $this->extension        = $user->extension;
        $this->departamento_id  = $user->departamento_id;
        $this->mostrarModal     = true;
    }

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

        // Solo añadimos password si se ha rellenado
        if (!empty($this->password)) {
            $data['password'] = bcrypt($this->password);
        }

        if ($this->idAEditar) {
            User::findOrFail($this->idAEditar)->update($data);
            session()->flash('toast', [
                'name'    => '¡Actualizado!',
                'message' => 'Empleado actualizado correctamente.',
            ]);
        } else {
            User::create($data);
            session()->flash('toast', [
                'name'    => '¡Creado!',
                'message' => 'Empleado creado correctamente.',
            ]);
        }

        $this->cerrarModal();
    }

    public function confirmarEliminar(int $id)
    {
        $this->idAEliminar = $id;
        $this->mostrarModalBorrar = true;
    }

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
    private function resetForm()
    {
        $this->reset(['nombre','email','telefono','extension','departamento_id','password']);
        $this->resetValidation();
    }

    public function getDepartamentosProperty()
    {
        return Departamento::orderBy('nombre')->get();
    }
}
