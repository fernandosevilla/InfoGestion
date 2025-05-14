@extends('layouts.base.admin')

@section('title', 'Departamentos')

@section('content_header')
    {{-- BREADCRUMB --}}
    <div class="w-full px-4 mb-6">
        <nav class="flex items-center w-full px-5 py-3 text-gray-700 border border-gray-200
                    rounded-lg bg-gray-50 dark:bg-[#262626] dark:border-[#262626]"
            aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center text-sm font-medium text-gray-700
                              hover:text-gray-500 dark:text-gray-400 dark:hover:text-white">
                        <i class="fa-solid fa-house align-middle"></i>&nbsp; Inicio
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="rtl:rotate-180 block w-3 h-3 mx-1 text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span
                            class="ms-1 text-sm font-medium text-gray-500 md:ms-2
                                     dark:text-gray-400">
                            Departamentos
                        </span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>
@endsection

@section('content')
    <div class="w-full px-4 py-6">
        @livewire('departamentos.tabla-departamentos')
    </div>
@endsection
