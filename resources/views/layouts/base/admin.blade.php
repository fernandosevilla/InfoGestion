<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Panel de Administración')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicons/favicon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen bg-gray-100 dark:bg-[#303030]">

    {{-- Aquí colgamos el menú + drawer backdrop: --}}
    @include('components.menu_sidebar')

    <div class="flex h-screen">
        {{-- espacio reservado de 64px para el sidebar en desktop --}}
        <div class="hidden sm:block w-64 flex-shrink-0"></div>

        {{-- contenido principal --}}
        <main class="flex-1 overflow-y-auto">
            <div class="container mx-auto px-6 py-6">
                @hasSection('content_header')
                    <div class="mb-6">
                        @yield('content_header')
                    </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
    @livewireScripts
</body>

</html>
