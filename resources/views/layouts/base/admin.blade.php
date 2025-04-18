<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Panel de Administración')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicons/favicon.png') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <div class="flex">

        <!-- Botón para abrir el sidebar en pantallas pequeñas -->
        <x-menu_sidebar />

        <!-- Contenido principal -->
        <div class="p-4 sm:ml-64">
            @yield('content')
        </div>
    </div>
</body>

</html>
