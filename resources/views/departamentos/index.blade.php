@extends('layouts.base.admin')

@section('title', 'Departamentos')

@section('content')
    <div class="w-full px-4 py-6">
        @livewire('departamentos.tabla-departamentos')
    </div>
@endsection

