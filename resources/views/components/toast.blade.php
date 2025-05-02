@props(['name' => 'success', 'message'])

@php
    // Colores por tipo
    $colors = [
        'success' => [
            'wrapper' => 'bg-white text-gray-800 dark:bg-[#262626] dark:text-gray-100',
            'iconBg'  => 'bg-green-100 text-green-600 dark:bg-green-800 dark:text-green-200',
        ],
        'danger'  => [
            'wrapper' => 'bg-white text-gray-800 dark:bg-[#262626] dark:text-gray-100',
            'iconBg'  => 'bg-red-100 text-red-600 dark:bg-red-800 dark:text-red-200',
        ],
        'warning' => [
            'wrapper' => 'bg-white text-gray-800 dark:bg-[#262626] dark:text-gray-100',
            'iconBg'  => 'bg-orange-100 text-orange-500 dark:bg-orange-700 dark:text-orange-200',
        ],
    ];

    $cfg = $colors[$name] ?? $colors['success'];

    // SVGs por tipo
    $icons = [
        'success' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                         <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707
                                  8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0
                                  1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0
                                  1 1.414 1.414Z"/>
                     </svg>',
        'danger'  => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                         <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51
                                  9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1
                                  1-1.414 1.414L10 11.414l-2.293
                                  2.293a1 1 0 0 1-1.414-1.414L8.586
                                  10 6.293 7.707a1 1 0 0
                                  1 1.414-1.414L10 8.586l2.293-2.293a1
                                  1 0 0 1 1.414 1.414L11.414
                                  10l2.293 2.293Z"/>
                     </svg>',
        'warning' => '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                         <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51
                                  9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2
                                  1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2
                                  0V6a1 1 0 0 1 2 0v5Z"/>
                     </svg>',
    ];

    $iconSvg = $icons[$name] ?? $icons['success'];
@endphp

<div
    id="custom-toast"
    class="fixed top-5 right-5 flex items-center max-w-xs w-full p-4 {{ $cfg['wrapper'] }} rounded-lg shadow"
    role="alert"
    wire:poll.4s="$refresh"
>
    <div class="inline-flex items-center justify-center w-8 h-8 rounded-lg {{ $cfg['iconBg'] }}">
        {!! $iconSvg !!}
        <span class="sr-only">{{ ucfirst($name) }} icon</span>
    </div>
    <div class="ml-3 text-sm font-normal">
        {{ $message }}
    </div>
</div>
