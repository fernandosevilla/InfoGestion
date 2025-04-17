@php
    use Illuminate\Support\Facades\Route;

    $menu = config('menu');
@endphp

@foreach ($menu as $item)
    @if (isset($item['type']) && $item['type'] === 'header')
        @canany($item['can'])
            <li class="px-2 text-xs text-gray-400 uppercase font-semibold mt-4">{{ $item['text'] }}</li>
        @endcanany
    @else
        @canany($item['can'] ?? [])
            <li>
                <a href="{{ route($item['route']) }}"
                   class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 group">
                    <i class="{{ $item['icon'] ?? 'fas fa-circle' }} w-5 h-5 text-gray-500"></i>
                    <span class="ms-3">{{ $item['text'] }}</span>
                </a>
            </li>
        @endcanany
    @endif
@endforeach
