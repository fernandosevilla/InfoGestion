<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth','can:ver-departamentos'])->group(function () {
    Route::view('/departamentos','departamentos.index')
    ->name('departamentos.index');
});

Route::middleware(['auth','can:ver-empleados'])->group(function () {
    Route::view('/empleados','empleados.index')
    ->name('empleados.index');
});

require __DIR__.'/auth.php';
