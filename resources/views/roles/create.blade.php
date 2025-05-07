@extends('layouts.base.admin')

@section('title', 'Crear Rol')

@section('content')
    <div class="w-full px-4 py-6">
        @livewire('roles.form-rol')
    </div>
@endsection
