@php
    $menu = config('menu');
@endphp

<!-- Botón para abrir el menú en responsive -->
<button data-drawer-target="separator-sidebar" data-drawer-toggle="separator-sidebar"
    aria-controls="separator-sidebar" type="button"
    class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Abrir menú</span>
    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
        <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"/>
    </svg>
</button>

<aside id="separator-sidebar"
       class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
       aria-label="Sidebar">
    <nav class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-[#262626]">
        <div class="flex justify-center mb-4">
            {{-- Logo para modo claro --}}
            <img src="{{ asset('img/logo_infogestion_modoClaro.webp') }}"
                alt="Logo InfoGestión claro"
                class="h-16 object-contain block dark:hidden" />

            {{-- Logo para modo oscuro --}}
            <img src="{{ asset('img/logo_infogestion_modoOscuro.webp') }}"
                alt="Logo InfoGestión oscuro"
                class="h-16 object-contain hidden dark:block" />
        </div>

        <hr class="border-t border-gray-300 dark:border-gray-600 mb-4">

        <ul class="space-y-2 font-medium">
            @foreach ($menu as $item)
                @if (isset($item['type']) && $item['type'] === 'header')
                    @canany($item['can'])
                        <li class="px-2 pt-6 text-xs font-semibold tracking-widest text-orange-600 uppercase dark:text-orange-400">
                            {{ $item['text'] }}
                        </li>
                    @endcanany
                @else
                    @canany($item['can'] ?? [])
                        @php
                            // Verificar si la ruta actual coincide con la ruta del item para dejarla como activo
                            $isActive = isset($item['route']) && request()->routeIs($item['route']);
                        @endphp
                        <li>
                            <a href="{{ isset($item['route']) ? route($item['route']) : '#' }}"
                               class="flex items-center px-4 py-2 text-sm transition-all duration-150 rounded-lg
                               {{ $isActive
                                   ? 'bg-orange-100 text-orange-700 dark:bg-orange-700 dark:text-white'
                                   : 'text-gray-800 hover:bg-[#d9d9d9] dark:text-gray-200 dark:hover:bg-[#3e3e3e]' }}">
                                <i class="{{ $item['icon'] ?? 'fas fa-circle' }} w-4 h-4 mr-3"></i>
                                <span class="truncate">{{ $item['text'] }}</span>
                            </a>
                        </li>
                    @endcanany
                @endif
            @endforeach
        </ul>
    </nav>
</aside>
