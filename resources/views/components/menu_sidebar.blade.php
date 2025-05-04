@php
    $menu = config('menu');
@endphp

<!-- Botón para abrir el menú en responsive -->
<button data-drawer-target="separator-sidebar" data-drawer-toggle="separator-sidebar" aria-controls="separator-sidebar"
    type="button"
    class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden
           hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200
           dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Abrir menú</span>
    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0
               012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010
               1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0
               01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012
               10z" />
    </svg>
</button>

<aside id="separator-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <nav class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-[#262626]">
        <div class="flex justify-center mb-4">
            <img src="{{ asset('img/logo_infogestion_modoClaro.webp') }}" alt="Logo claro"
                class="h-16 object-contain block dark:hidden" />
            <img src="{{ asset('img/logo_infogestion_modoOscuro.webp') }}" alt="Logo oscuro"
                class="h-16 object-contain hidden dark:block" />
        </div>

        <hr class="border-t border-gray-300 dark:border-gray-600 mb-4">

        <ul class="space-y-2 font-medium">
            @foreach ($menu as $item)
                {{-- Header de sección --}}
                @if (isset($item['type']) && $item['type'] === 'header')
                    @canany($item['can'])
                        <li
                            class="px-2 pt-6 text-xs font-semibold tracking-widest
                                   text-orange-600 uppercase dark:text-orange-400">
                            {{ $item['text'] }}
                        </li>
                    @endcanany

                    {{-- Ítem con submenu --}}
                @elseif (isset($item['submenu']))
                    @canany($item['can'] ?? [])
                        <li>
                            <details class="group">
                                <summary
                                    class="flex items-center justify-between w-full px-4 py-2 text-sm
                                           rounded-lg cursor-pointer transition-colors duration-150
                                           text-gray-800 hover:bg-[#d9d9d9]
                                           dark:text-gray-200 dark:hover:bg-[#3e3e3e]">
                                    <div class="flex items-center">
                                        <i class="{{ $item['icon'] ?? 'fas fa-circle' }}
                                                   w-4 h-4 mr-3">
                                        </i>
                                        <span class="truncate">{{ $item['text'] }}</span>
                                    </div>
                                    <svg class="w-4 h-4 transform transition-transform duration-300
                                               rotate-90 group-open:rotate-0"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10
                                                   11.292l3.71-4.06a.75.75 0
                                                   111.08 1.04l-4.25 4.65a.75.75
                                                   0 01-1.08 0l-4.25-4.65a.75.75
                                                   0 01.02-1.06z" />
                                    </svg>
                                </summary>

                                <!-- Submenú con animación suave de altura -->
                                <ul
                                    class="overflow-hidden max-h-0 transition-[max-height] duration-300
                                           ease-in-out group-open:max-h-screen">
                                    @foreach ($item['submenu'] as $subitem)
                                        @canany($subitem['can'] ?? [])
                                            @php
                                                $isActive =
                                                    isset($subitem['route']) && request()->routeIs($subitem['route']);
                                            @endphp
                                            <li>
                                                <a href="{{ isset($subitem['route']) ? route($subitem['route']) : '#' }}"
                                                    class="flex items-center w-full px-6 py-2 text-sm
                                                           rounded-lg transition-colors duration-150
                                                           {{ $isActive
                                                               ? 'bg-orange-100 text-orange-700
                                                                  dark:bg-orange-700 dark:text-white'
                                                               : 'text-gray-800 hover:bg-[#d9d9d9]
                                                                  dark:text-gray-200
                                                                  dark:hover:bg-[#3e3e3e]' }}">
                                                    <i class="{{ $subitem['icon'] ?? 'fas fa-dot-circle' }}
                                                               w-3 h-3 mr-3">
                                                    </i>
                                                    <span class="truncate">{{ $subitem['text'] }}</span>
                                                </a>
                                            </li>
                                        @endcanany
                                    @endforeach
                                </ul>
                            </details>
                        </li>
                    @endcanany

                    {{-- Ítem sin submenu --}}
                @else
                    @canany($item['can'] ?? [])
                        @php
                            $isActive = isset($item['route']) && request()->routeIs($item['route']);
                        @endphp
                        <li>
                            <a href="{{ isset($item['route']) ? route($item['route']) : '#' }}"
                                class="flex items-center px-4 py-2 text-sm
                                       rounded-lg transition-colors duration-150
                                       {{ $isActive
                                           ? 'bg-orange-100 text-orange-700
                                              dark:bg-orange-700 dark:text-white'
                                           : 'text-gray-800 hover:bg-[#d9d9d9]
                                              dark:text-gray-200
                                              dark:hover:bg-[#3e3e3e]' }}">
                                <i class="{{ $item['icon'] ?? 'fas fa-circle' }}
                                           w-4 h-4 mr-3">
                                </i>
                                <span class="truncate">{{ $item['text'] }}</span>
                            </a>
                        </li>
                    @endcanany
                @endif
            @endforeach
        </ul>
    </nav>
</aside>


<script>
    document.querySelectorAll('#separator-sidebar details').forEach(detail => {
        const submenu = detail.querySelector('ul');
        // estilo base
        submenu.style.overflow = 'hidden';
        submenu.style.height = '0';
        submenu.style.transition = 'height 0.3s ease';

        detail.addEventListener('toggle', e => {
            if (detail.open) {
                // de 0 a su altura real
                submenu.style.display = 'block';
                requestAnimationFrame(() => {
                    submenu.style.height = submenu.scrollHeight + 'px';
                });
                submenu.addEventListener('transitionend', function done() {
                    // una vez abierto, quitamos la altura fija para que crezca con contenido
                    submenu.style.height = 'auto';
                    submenu.removeEventListener('transitionend', done);
                });
            } else {
                // de altura real (auto) a 0
                // primero fijamos la altura actual
                submenu.style.height = submenu.scrollHeight + 'px';
                requestAnimationFrame(() => {
                    submenu.style.height = '0';
                });
                submenu.addEventListener('transitionend', function done() {
                    submenu.style.display = '';
                    submenu.removeEventListener('transitionend', done);
                });
            }
        });
    });
</script>
