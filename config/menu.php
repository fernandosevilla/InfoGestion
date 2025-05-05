<?php

return [
    [
        'type' => 'header',
        'text' => 'CLIENTES',
        'can' => ['ver-clientes']
    ],
    [
        'text' => 'Listado Clientes',
        'icon' => 'fas fa-yin-yang',
        'route' => 'dashboard',
        'can' => ['ver-clientes'],
    ],
    [
        'text' => 'Crear Cliente',
        'icon' => 'fas fa-user',
        'route' => 'profile.update',
        'can' => ['crear-clientes'],
    ],
    [
        'type' => 'header',
        'text' => 'ADMINISTRACIÓN',
        'can' => ['ver-clientes']
    ],
    [
        'text' => 'Departamentos',
        'icon' => 'fas fa-store-alt',
        'can' => ['ver-departamentos'],
        'route' => 'departamentos.index',
    ],
    [
        'text' => 'Empleados',
        'icon' => 'fas fa-users',
        'can' => ['ver-empleados'],
        'route' => 'empleados.index',
    ],
];
