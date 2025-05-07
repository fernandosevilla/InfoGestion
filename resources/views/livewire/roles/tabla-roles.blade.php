<div class="relative">
    {{-- TOAST --}}
    @if (session('toast'))
        <x-toast :name="session('toast.name')" :message="session('toast.message')" />
    @endif

    {{-- TABLA --}}
    <div class="w-full shadow-md sm:rounded-lg overflow-hidden bg-white dark:bg-[#262626]">
        {{-- ENCABEZADO: TÍTULO + CREAR --}}
        <div
            class="px-6 py-4 bg-white dark:bg-[#262626] border-b border-gray-200 dark:border-[#3e3e3e] flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100">Roles</h2>
            @can('crear-roles')
                <a href="{{ route('roles.create') }}"
                    class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition">
                    Crear rol
                </a>
            @endcan
        </div>
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
                        @canany(['editar-roles', 'eliminar-roles'])
                            <th class="px-6 py-3 font-semibold uppercase">Acciones</th>
                        @endcanany
                    </tr>
                </thead>
                <tbody id="cuerpoTabla">
                    @forelse($roles as $r)
                        <tr wire:key="rol-{{ $r->id }}"
                            class="border-b border-gray-200 dark:border-[#3e3e3e] hover:bg-gray-100 dark:hover:bg-[#3e3e3e]">
                            <td class="px-6 py-2 font-medium">{{ $r->name }}</td>
                            <td class="px-6 py-2 space-x-2">
                                @can('editar-roles')
                                    <a href="{{ route('roles.edit', $r) }}"
                                        class="px-3 py-1 text-sm font-medium
                                               bg-gray-100 text-gray-700 border border-gray-200 rounded
                                               hover:bg-gray-200 focus:outline-none focus:ring-1 focus:ring-gray-500
                                               dark:bg-[#3e3e3e] dark:text-gray-100 dark:border-[#444444] dark:hover:bg-[#444444]">
                                        Editar
                                    </a>
                                @endcan

                                @can('eliminar-roles')
                                    <button wire:click="confirmarEliminar({{ $r->id }})"
                                        class="px-3 py-1 text-sm font-medium
                                            bg-red-100 text-red-600 border border-red-200 rounded
                                            hover:bg-red-200 focus:outline-none focus:ring-1 focus:ring-red-500
                                            dark:bg-[#3e3e3e] dark:text-red-400 dark:border-[#444444] dark:hover:bg-[#444444]">
                                        Eliminar
                                    </button>
                                @endcan
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                No hay roles
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- paginación --}}
        <div class="px-6 py-4 bg-white dark:bg-[#262626] border-t border-gray-200 dark:border-[#3e3e3e]">
            {{ $roles->links('vendor.pagination.tailwind') }}
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
                    Este rol se eliminará permanentemente.
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
