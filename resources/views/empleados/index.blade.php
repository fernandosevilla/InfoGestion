@extends('layouts.base.admin')

@section('title', 'Empleados')

@section('content')
    <div class="w-full px-4 py-6">
        @livewire('empleados.tabla-empleados')
    </div>
@endsection

