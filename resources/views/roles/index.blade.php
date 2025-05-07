@extends('layouts.base.admin')

@section('title', 'Roles')

@section('content')
    <div class="w-full px-4 py-6">
        @livewire('roles.tabla-roles')
    </div>
@endsection
