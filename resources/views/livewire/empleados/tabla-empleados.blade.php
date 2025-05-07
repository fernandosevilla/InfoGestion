<div class="relative">

    {{-- TOAST --}}
    @if (session('toast'))
        <x-toast :name="session('toast.name')" :message="session('toast.message')" />
    @endif

    {{-- TABLA --}}
    <div class="w-full shadow-md sm:rounded-lg overflow-hidden bg-white dark:bg-[#262626]">
        {{-- buscador --}}
        <div class="px-6 py-4 bg-white dark:bg-[#262626] border-b border-gray-200 dark:border-[#3e3e3e]">
            <input id="buscador" type="text" placeholder="Buscar empleado..."
                class="w-full max-w-md px-4 py-2
                       border border-gray-300 dark:border-[#3e3e3e]
                       rounded-lg bg-gray-50 dark:bg-[#3e3e3e]
                       text-gray-900 dark:text-gray-100
                       placeholder-gray-500 dark:placeholder-gray-400
                       focus:outline-none focus:ring-1 focus:ring-gray-500" />
        </div>

        {{-- datos --}}
        <div class="overflow-x-auto w-full">
            <table class="min-w-full table-auto text-sm md:text-base text-left text-gray-900 dark:text-gray-100">
                <thead class="bg-gray-50 dark:bg-[#262626]">
                    <tr>
                        <th class="px-6 py-3 font-semibold uppercase">Nombre</th>
                        <th class="px-6 py-3 font-semibold uppercase">Teléfono</th>
                        <th class="px-6 py-3 font-semibold uppercase">Extensión</th>
                        <th class="px-6 py-3 font-semibold uppercase">Email</th>
                        <th class="px-6 py-3 font-semibold uppercase">Departamento</th>

                        @canany(['editar-empleados', 'eliminar-empleados'])
                            <th class="px-6 py-3 font-semibold uppercase">Acciones</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody id="cuerpoTabla">
                    @forelse($empleados as $e)
                        <tr wire:key="departamento-{{ $e->id }}"
                            class="border-b border-gray-200 dark:border-[#3e3e3e] hover:bg-gray-100 dark:hover:bg-[#3e3e3e]">
                            <td class="px-6 py-2 font-medium">{{ $e->name }}</td>
                            <td class="px-6 py-2 font-medium">{{ $e->telefono ?? 'Sin número de teléfono' }}</td>
                            <td class="px-6 py-2 font-medium">{{ $e->extension ?? 'Sin extensión' }}</td>
                            <td class="px-6 py-2 font-medium">{{ $e->email ?? 'Sin email' }}</td>
                            <td class="px-6 py-2 font-medium">{{ $e->departamento->nombre ?? 'Sin departamento' }}</td>
                            <td class="px-6 py-2 space-x-2">
                                @canany(['editar-empleados'])
                                    <button wire:click="editar({{ $e->id }})"
                                        class="px-3 py-1 text-sm font-medium
                                               bg-gray-100 text-gray-700 border border-gray-200 rounded
                                               hover:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-gray-500
                                               dark:bg-[#3e3e3e] dark:text-gray-100 dark:border-[#444444] dark:hover:bg-[#444444]">
                                        Editar
                                    </button>
                                @endcanany
                                @canany(['eliminar-empleados'])
                                    <button wire:click="confirmarEliminar({{ $e->id }})"
                                        class="px-3 py-1 text-sm font-medium
                                               bg-red-100 text-red-600 border border-red-200 rounded
                                               hover:bg-red-200 focus:outline-none focus:ring-1 focus:ring-red-500
                                               dark:bg-[#3e3e3e] dark:text-red-400 dark:border-[#444444] dark:hover:bg-[#444444]">
                                        Eliminar
                                    </button>
                                @endcanany
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                No hay empleados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- paginación --}}
        <div class="px-6 py-4 bg-white dark:bg-[#262626] border-t border-gray-200 dark:border-[#3e3e3e]">
            {{ $empleados->links('vendor.pagination.tailwind') }}
        </div>
    </div>


    {{-- Botón Nuevo --}}
    @canany(['crear-empleados'])
        <div class="mt-4 flex justify-center">
            <button wire:click="abrirModal()" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                Nuevo empleado
            </button>
        </div>
    @endcanany

    {{-- MODAL CREAR/EDITAR --}}
    <div
        class="{{ $mostrarModal ? 'flex' : 'hidden' }}
            fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50">
        <div class="bg-white dark:bg-[#262626] rounded-lg max-w-md w-full shadow-lg overflow-hidden">
            <!-- Encabezado y cierre -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-[#3e3e3e]">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">
                    {{ $idAEditar ? 'Editar empleado' : 'Crear empleado' }}
                </h2>
                <button type="button" wire:click="$set('mostrarModal', false)"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-[#444444] dark:hover:text-white">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <span class="sr-only">Cerrar</span>
                </button>
            </div>

            <!-- Cuerpo del formulario -->
            <form class="p-6" wire:submit.prevent="guardar">
                {{-- Nombre --}}
                <div class="mb-2">
                    <label for="nombre" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Nombre
                    </label>
                    <input id="nombre" wire:model.defer="nombre" type="text" placeholder="Nombre del empleado"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-[#3e3e3e]
                            rounded-lg bg-gray-50 dark:bg-[#3e3e3e]
                            text-gray-900 dark:text-gray-100
                            placeholder-gray-500 dark:placeholder-gray-400
                            focus:outline-none focus:ring-1 focus:ring-gray-500" />
                    @error('nombre')
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="mb-2">
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Email
                    </label>
                    <input id="email" wire:model.defer="email" type="email" placeholder="Email"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-[#3e3e3e]
                            rounded-lg bg-gray-50 dark:bg-[#3e3e3e]
                            text-gray-900 dark:text-gray-100
                            placeholder-gray-500 dark:placeholder-gray-400
                            focus:outline-none focus:ring-1 focus:ring-gray-500" />
                    @error('email')
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Teléfono y Extensión en la misma fila --}}
                <div class="grid grid-cols-2 gap-2 mb-2">
                    {{-- Teléfono --}}
                    <div>
                        <label for="telefono" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Teléfono
                        </label>
                        <input id="telefono" wire:model.defer="telefono" type="text" placeholder="Teléfono"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-[#3e3e3e]
                                rounded-lg bg-gray-50 dark:bg-[#3e3e3e]
                                text-gray-900 dark:text-gray-100
                                placeholder-gray-500 dark:placeholder-gray-400
                                focus:outline-none focus:ring-1 focus:ring-gray-500" />
                    </div>

                    {{-- Extensión --}}
                    <div>
                        <label for="extension" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                            Extensión
                        </label>
                        <input id="extension" wire:model.defer="extension" type="text" placeholder="Extensión"
                            class="w-full px-4 py-2 border border-gray-300 dark:border-[#3e3e3e]
                                rounded-lg bg-gray-50 dark:bg-[#3e3e3e]
                                text-gray-900 dark:text-gray-100
                                placeholder-gray-500 dark:placeholder-gray-400
                                focus:outline-none focus:ring-1 focus:ring-gray-500" />
                    </div>
                </div>
                @error('telefono')
                    <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror
                @error('extension')
                    <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror

                {{-- Departamento --}}
                <div class="mb-2">
                    <label for="departamento" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Departamento
                    </label>
                    <select id="departamento" wire:model.defer="departamento_id"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-[#3e3e3e]
                                rounded-lg bg-gray-50 dark:bg-[#3e3e3e]
                                text-gray-900 dark:text-gray-100
                                focus:outline-none focus:ring-1 focus:ring-gray-500">
                        <option value="">-- Seleccionar departamento --</option>
                        @foreach ($departamentos as $d)
                            <option value="{{ $d->id }}">{{ $d->nombre }}</option>
                        @endforeach
                    </select>
                    @error('departamento_id')
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Rol --}}
                <div class="mb-2">
                    <label for="rol" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Rol
                    </label>
                    <select id="rol" wire:model.defer="rol"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-[#3e3e3e]
                               rounded-lg bg-gray-50 dark:bg-[#3e3e3e]
                               text-gray-900 dark:text-gray-100
                               focus:outline-none focus:ring-1 focus:ring-gray-500">
                        <option value="">-- Seleccionar rol --</option>
                        @foreach ($roles as $r)
                            <option value="{{ $r->name }}">{{ $r->name }}</option>
                        @endforeach
                    </select>
                    @error('rol')
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Contraseña --}}
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                        Contraseña
                    </label>
                    <input id="password" wire:model.defer="password" type="password" placeholder="Contraseña"
                        class="w-full px-4 py-2 border border-gray-300 dark:border-[#3e3e3e]
                            rounded-lg bg-gray-50 dark:bg-[#3e3e3e]
                            text-gray-900 dark:text-gray-100
                            placeholder-gray-500 dark:placeholder-gray-400
                            focus:outline-none focus:ring-1 focus:ring-gray-500" />
                    @error('password')
                        <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="flex justify-end space-x-2">
                    <button type="button" wire:click="$set('mostrarModal', false)"
                        class="px-4 py-2 bg-gray-200 dark:bg-[#262626] text-gray-800 dark:text-gray-100
                            rounded-lg hover:bg-gray-300 dark:hover:bg-[#444444]
                            focus:outline-none focus:ring-2 focus:ring-gray-400">
                        Cancelar
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        {{ $idAEditar ? 'Actualizar' : 'Guardar' }}
                    </button>
                </div>
            </form>
        </div>
    </div>


    {{-- MODAL ELIMINAR --}}
    <div
        class="{{ $mostrarModalBorrar ? 'flex' : 'hidden' }}
                fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50">
        <div class="bg-white dark:bg-[#262626] rounded-lg overflow-hidden shadow-lg max-w-sm w-full">
            <div class="p-6 text-center">
                <h2 class="text-lg font-semibold text-gray-800 dark:text-gray-100">
                    ¿Estás seguro?
                </h2>
                <p class="mt-2 text-gray-600 dark:text-gray-300">
                    Este empleado se eliminará permanentemente.
                </p>
                <div class="mt-4 flex justify-center space-x-3">
                    <button wire:click="eliminar"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-800
                               focus:outline-none focus:ring-2 focus:ring-red-400">
                        Eliminar
                    </button>

                    <button wire:click="$set('mostrarModalBorrar', false)"
                        class="px-4 py-2 bg-gray-200 dark:bg-[#3e3e3e] text-gray-800
                             dark:text-gray-100 rounded-lg hover:bg-gray-300 dark:hover:bg-[#444444]
                               focus:outline-none focus:ring-2 focus:ring-gray-400">
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const buscador = document.getElementById('buscador')
        const filas = document.querySelectorAll('#cuerpoTabla tr')

        buscador.addEventListener('input', () => {
            const texto = buscador.value.trim().toLowerCase()
            filas.forEach(tr => {
                const nombre = tr.querySelector('td')?.textContent.trim().toLowerCase() || ''
                tr.style.display = nombre.startsWith(texto) ? '' : 'none'
            })
        })
    })
</script>
