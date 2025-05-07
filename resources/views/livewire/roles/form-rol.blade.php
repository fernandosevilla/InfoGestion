<div class="max-w-8xl mx-auto p-6 bg-white dark:bg-[#262626] rounded-lg shadow">
    {{-- Título --}}
    <h2 class="text-2xl font-semibold mb-6 text-gray-900 dark:text-gray-100">
        {{ $role->exists ? 'Editar rol' : 'Crear rol' }}
    </h2>

    <form wire:submit.prevent="guardar" class="space-y-6">
        {{-- Nombre del rol --}}
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">
                Nombre del rol
            </label>
            <input
                wire:model.defer="nombre"
                id="name"
                type="text"
                class="mt-1 block w-full rounded border-gray-300 dark:border-[#3e3e3e]
                       bg-gray-50 dark:bg-[#3e3e3e] text-gray-900 dark:text-gray-100
                       placeholder-gray-500 dark:placeholder-gray-400
                       focus:outline-none focus:ring-1 focus:ring-gray-500"
                placeholder="p.ej. administrador"
            >
            @error('nombre')
                <p class="mt-1 text-red-500 text-sm">{{ $message }}</p>
            @enderror
        </div>

        {{-- Permisos en dos cards --}}
        <div class="flex flex-col space-y-6">
            {{-- Card Empleado --}}
            <div class="bg-white dark:bg-[#262626] shadow rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">
                    Permisos Empleado
                </h3>
                <div class="space-y-3">
                    @php
                        $permisosEmpleado = [
                            'ver-empleados','ver-clientes','ver-contratos',
                            'ver-inventarios','editar-inventarios',
                            'ver-avisos','crear-avisos','editar-avisos','eliminar-avisos',
                            'ver-partes','crear-partes','editar-partes','eliminar-partes','firmar-partes',
                            'iniciar-intervencion','finalizar-intervencion',
                            'ver-materiales','aniadir-materiales','editar-materiales','eliminar-materiales',
                        ];
                    @endphp

                    @foreach ($permisosEmpleado as $perm)
                        <label class="inline-flex items-center me-5 cursor-pointer">
                            <input
                                type="checkbox"
                                wire:model="permisosSeleccionados"
                                value="{{ $perm }}"
                                class="sr-only peer"
                            >
                            <div
                                class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-[#3e3e3e]
                                       peer-focus:ring-4 peer-focus:ring-orange-300 dark:peer-focus:ring-orange-800
                                       peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full
                                       peer-checked:after:border-white
                                       after:content-[''] after:absolute after:top-0.5 after:start-[2px]
                                       after:bg-white after:border-gray-300 after:border after:rounded-full
                                       after:h-5 after:w-5 after:transition-all
                                       dark:border-gray-600 peer-checked:bg-orange-500 dark:peer-checked:bg-orange-500">
                            </div>
                            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{ str_replace('-', ' ', ucfirst($perm)) }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>

            {{-- Card Admin --}}
            <div class="bg-white dark:bg-[#262626] shadow rounded-lg p-6">
                <h3 class="text-xl font-semibold mb-4 text-gray-900 dark:text-gray-100">
                    Permisos Admin
                </h3>
                <div class="space-y-3">
                    @php
                        $permisosAdmin = [
                            'crear-empleados','editar-empleados','eliminar-empleados',
                            'ver-departamentos','crear-departamentos','editar-departamentos','eliminar-departamentos',
                            'crear-clientes','editar-clientes','eliminar-clientes',
                            'crear-contratos','editar-contratos','eliminar-contratos',
                            'crear-inventarios','eliminar-inventarios',
                            'ver-roles','crear-roles','editar-roles','eliminar-roles',
                        ];
                    @endphp

                    @foreach ($permisosAdmin as $perm)
                        <label class="inline-flex items-center me-5 cursor-pointer">
                            <input
                                type="checkbox"
                                wire:model="permisosSeleccionados"
                                value="{{ $perm }}"
                                class="sr-only peer"
                            >
                            <div
                                class="relative w-11 h-6 bg-gray-200 rounded-full peer dark:bg-[#3e3e3e]
                                       peer-focus:ring-4 peer-focus:ring-orange-300 dark:peer-focus:ring-orange-800
                                       peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full
                                       peer-checked:after:border-white
                                       after:content-[''] after:absolute after:top-0.5 after:start-[2px]
                                       after:bg-white after:border-gray-300 after:border after:rounded-full
                                       after:h-5 after:w-5 after:transition-all
                                       dark:border-gray-600 peer-checked:bg-orange-500 dark:peer-checked:bg-orange-500">
                            </div>
                            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                                {{ str_replace('-', ' ', ucfirst($perm)) }}
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Botones Acción --}}
        <div class="flex justify-end space-x-3">
            <a href="{{ route('roles.index') }}"
               class="px-4 py-2 bg-gray-200 dark:bg-[#3e3e3e] text-gray-800
                      dark:text-gray-100 rounded-lg hover:bg-gray-300 dark:hover:bg-[#444444]
                      focus:outline-none focus:ring-2 focus:ring-gray-400">
                Cancelar
            </a>
            <button
                type="submit"
                class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                {{ $role->exists ? 'Actualizar rol' : 'Crear rol' }}
            </button>
        </div>
    </form>
</div>
