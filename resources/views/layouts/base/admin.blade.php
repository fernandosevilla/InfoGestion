<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Panel de Administración')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicons/favicon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="min-h-screen bg-gray-100">

    {{-- Aquí colgamos el menú + drawer backdrop: --}}
    @include('components.menu_sidebar')

    <div class="flex h-screen">
        {{-- espacio reservado de 64px para el sidebar en desktop --}}
        <div class="hidden sm:block w-64 flex-shrink-0"></div>

        {{-- contenido principal --}}
        <main class="flex-1 overflow-y-auto">
            <div class="container mx-auto px-6 py-6">
                @yield('content')
            </div>
        </main>
    </div>
    @livewireScripts
</body>

</html>
