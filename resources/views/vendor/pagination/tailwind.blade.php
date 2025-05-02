@if ($paginator->hasPages())
<nav role="navigation" aria-label="Paginación" class="flex items-center justify-between px-6 py-4 bg-white dark:bg-[#262626] dark:text-white">
    {{-- MÓVIL --}}
    <div class="flex justify-between flex-1 sm:hidden">
        {{-- Anterior --}}
        @if ($paginator->onFirstPage())
            <span class="inline-flex items-center px-4 py-2 text-sm font-medium bg-white text-gray-400 border border-gray-200 rounded-md dark:bg-[#3e3e3e] dark:text-gray-500 dark:border-[#3e3e3e] cursor-default">
                Anterior
            </span>
        @else
            <button
                wire:click="previousPage"
                wire:loading.attr="disabled"
                class="inline-flex items-center px-4 py-2 text-sm font-medium bg-white text-gray-800 border border-gray-200 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors duration-150 ease-in-out dark:bg-[#3e3e3e] dark:text-white dark:border-[#3e3e3e] dark:hover:bg-[#444444]"
            >
                Anterior
            </button>
        @endif

        {{-- Siguiente --}}
        @if ($paginator->hasMorePages())
            <button
                wire:click="nextPage"
                wire:loading.attr="disabled"
                class="inline-flex items-center px-4 py-2 ml-3 text-sm font-medium bg-white text-gray-800 border border-gray-200 rounded-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors duration-150 ease-in-out dark:bg-[#3e3e3e] dark:text-white dark:border-[#3e3e3e] dark:hover:bg-[#444444]"
            >
                Siguiente
            </button>
        @else
            <span class="inline-flex items-center px-4 py-2 ml-3 text-sm font-medium bg-white text-gray-400 border border-gray-200 rounded-md dark:bg-[#3e3e3e] dark:text-gray-500 dark:border-[#3e3e3e] cursor-default">
                Siguiente
            </span>
        @endif
    </div>

    {{-- ESCRITORIO --}}
    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
        {{-- Info --}}
        <p class="text-sm text-gray-700 dark:text-gray-400">
            Mostrando
            @if ($paginator->firstItem())
                <span class="font-medium">{{ $paginator->firstItem() }}</span> a <span class="font-medium">{{ $paginator->lastItem() }}</span>
            @else
                {{ $paginator->count() }}
            @endif
            de <span class="font-medium">{{ $paginator->total() }}</span> resultados
        </p>

        {{-- Enlaces numerados --}}
        <span class="relative z-0 inline-flex rounded-md shadow-sm">
            {{-- Prev --}}
            @if ($paginator->onFirstPage())
                <span aria-disabled="true" aria-label="Anterior">
                    <span class="inline-flex items-center px-2 py-2 text-sm font-medium bg-white text-gray-400 border border-gray-200 rounded-l-md dark:bg-[#3e3e3e] dark:text-gray-500 dark:border-[#3e3e3e] cursor-default">
                        &lsaquo;
                    </span>
                </span>
            @else
                <button
                    wire:click="previousPage"
                    wire:loading.attr="disabled"
                    aria-label="Anterior"
                    class="inline-flex items-center px-2 py-2 text-sm font-medium bg-white text-gray-800 border border-gray-200 rounded-l-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors duration-150 ease-in-out dark:bg-[#3e3e3e] dark:text-white dark:border-[#3e3e3e] dark:hover:bg-[#444444]"
                >
                    &lsaquo;
                </button>
            @endif

            {{-- Páginas --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <span aria-disabled="true">
                        <span class="inline-flex items-center px-4 py-2 -ml-px text-sm font-medium bg-white text-gray-700 border border-gray-200 dark:bg-[#3e3e3e] dark:text-white dark:border-[#3e3e3e]">
                            {{ $element }}
                        </span>
                    </span>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page">
                                <span class="inline-flex items-center px-4 py-2 -ml-px text-sm font-medium bg-gray-200 text-gray-800 border border-gray-300 cursor-default dark:bg-[#4a4a4a] dark:text-white dark:border-[#3e3e3e]">
                                    {{ $page }}
                                </span>
                            </span>
                        @else
                            <button
                                wire:click="gotoPage({{ $page }})"
                                wire:loading.attr="disabled"
                                class="inline-flex items-center px-4 py-2 -ml-px text-sm font-medium bg-white text-gray-800 border border-gray-200 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors duration-150 ease-in-out dark:bg-[#3e3e3e] dark:text-white dark:border-[#3e3e3e] dark:hover:bg-[#444444]"
                                aria-label="Ir a la página {{ $page }}"
                            >
                                {{ $page }}
                            </button>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next --}}
            @if ($paginator->hasMorePages())
                <button
                    wire:click="nextPage"
                    wire:loading.attr="disabled"
                    aria-label="Siguiente"
                    class="inline-flex items-center px-2 py-2 -ml-px text-sm font-medium bg-white text-gray-800 border border-gray-200 rounded-r-md hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors duration-150 ease-in-out dark:bg-[#3e3e3e] dark:text-white dark:border-[#3e3e3e] dark:hover:bg-[#444444]"
                >
                    &rsaquo;
                </button>
            @else
                <span aria-disabled="true" aria-label="Siguiente">
                    <span class="inline-flex items-center px-2 py-2 -ml-px text-sm font-medium bg-white text-gray-400 border border-gray-200 rounded-r-md dark:bg-[#3e3e3e] dark:text-gray-500 dark:border-[#3e3e3e] cursor-default">
                        &rsaquo;
                    </span>
                </span>
            @endif
        </span>
    </div>
</nav>
@endif
