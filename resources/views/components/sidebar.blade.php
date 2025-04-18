@php
    use Illuminate\Support\Facades\Route;

    $menu = config('menu');
@endphp

@foreach ($menu as $item)
    @if (isset($item['type']) && $item['type'] === 'header')
        @canany($item['can'])
            <li class="px-2 pt-6 text-xs font-semibold tracking-widest text-orange-600 uppercase dark:text-orange-400">
                {{ $item['text'] }}
            </li>
        @endcanany
    @else
        @canany($item['can'] ?? [])
            <li>
                <a href="{{ isset($item['route']) ? route($item['route']) : '#' }}"
                   class="flex items-center px-4 py-2 text-sm text-gray-800 hover:bg-[#d9d9d9] transition-all
                        duration-150 rounded-lg dark:text-gray-200 dark:hover:bg-[#3e3e3e]">

                    <i class="{{ $item['icon'] ?? 'fas fa-circle' }} w-4 h-4 mr-3"></i>
                    <span class="truncate">{{ $item['text'] }}</span>
                </a>
            </li>
        @endcanany
    @endif
@endforeach
