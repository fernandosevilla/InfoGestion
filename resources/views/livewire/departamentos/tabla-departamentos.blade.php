<div class="relative">

    {{-- TOAST --}}
    @if (session('toast'))
        <x-toast :name="session('toast.name')" :message="session('toast.message')" />
    @endif

    {{-- TABLA --}}
    <div class="w-full shadow-md sm:rounded-lg overflow-hidden bg-white dark:bg-[#262626]">
        {{-- buscador --}}
        <div class="px-6 py-4 bg-white dark:bg-[#262626] border-b border-gray-200 dark:border-[#3e3e3e]">
            <input id="buscador" type="text" placeholder="Buscar departamento..."
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
                        @canany(['editar-departamentos', 'eliminar-departamentos'])
                            <th class="px-6 py-3 font-semibold uppercase">Acciones</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody id="cuerpoTabla">
                    @forelse($departamentos as $d)
                        <tr wire:key="departamento-{{ $d->id }}"
                            class="border-b border-gray-200 dark:border-[#3e3e3e] hover:bg-gray-100 dark:hover:bg-[#3e3e3e]">
                            <td class="px-6 py-2 font-medium">{{ $d->nombre }}</td>
                            <td class="px-6 py-2 space-x-2">
                                @canany(['editar-departamentos'])
                                    <button wire:click="abrirModal({{ $d->id }})"
                                        class="px-3 py-1 text-sm font-medium
                                               bg-gray-100 text-gray-700 border border-gray-200 rounded
                                               hover:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-gray-500
                                               dark:bg-[#3e3e3e] dark:text-gray-100 dark:border-[#444444] dark:hover:bg-[#444444]">
                                    Editar
                                </button>
                                @endcanany
                                @canany(['eliminar-departamentos'])
                                    <button wire:click="confirmarEliminar({{ $d->id }})"
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
                                No hay departamentos
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- paginación --}}
        <div class="px-6 py-4 bg-white dark:bg-[#262626] border-t border-gray-200 dark:border-[#3e3e3e]">
            {{ $departamentos->links('vendor.pagination.tailwind') }}
        </div>
    </div>


    {{-- Botón Nuevo --}}
    @canany(['crear-departamentos'])
    <div class="mt-4 flex justify-center">
        <button wire:click="abrirModal()" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
            Nuevo departamento
        </button>
    </div>
    @endcanany

    {{-- MODAL CREAR/EDITAR --}}
    <div
        class="{{ $mostrarModal ? 'flex' : 'hidden' }}
           fixed inset-0 bg-black bg-opacity-50 items-center justify-center z-50">
        <div class="bg-white dark:bg-[#262626] rounded-lg max-w-md w-full shadow-lg overflow-hidden">
            <div class="p-6">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-4">
                    {{ $idAEditar ? 'Editar departamento' : 'Crear departamento' }}
                </h2>
                <input wire:model.defer="nombre" type="text" placeholder="Nombre del departamento"
                    class="w-full px-4 py-2 border border-gray-300 dark:border-[#3e3e3e]
                           rounded-lg bg-gray-50 dark:bg-[#3e3e3e]
                           text-gray-900 dark:text-gray-100
                           placeholder-gray-500 dark:placeholder-gray-400
                           focus:outline-none focus:ring-1 focus:ring-gray-500 mb-2" />

                @error('nombre')
                    <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                @enderror

                <div class="mt-4 flex justify-end space-x-2">
                    <button wire:click="$set('mostrarModal', false)"
                        class="px-4 py-2 bg-gray-200 dark:bg-[#3e3e3e] text-gray-800
                            dark:text-gray-100 rounded-lg hover:bg-gray-300 dark:hover:bg-[#444444]
                              focus:outline-none focus:ring-2 focus:ring-gray-400">
                        Cancelar
                    </button>

                    <button wire:click="guardar"
                        class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Guardar
                    </button>
                </div>
            </div>
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
                    Este departamento se eliminará permanentemente.
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
