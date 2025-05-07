@extends('layouts.base.admin')

@section('title', 'Roles')

@section('content')
    <div class="w-full px-4 py-6">
        @livewire('roles.form-rol', ['role' => $role])
    </div>
@endsection
