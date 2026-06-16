<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\PrestamoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// CRUDs Resources completas
Route::resource('equipos', EquipoController::class);

// Préstamos con ruta explícita POST para devoluciones
Route::get('prestamos', [PrestamoController::class, 'index'])->name('prestamos.index');
Route::get('prestamos/crear', [PrestamoController::class, 'create'])->name('prestamos.create');
Route::post('prestamos', [PrestamoController::class, 'store'])->name('prestamos.store');
Route::post('prestamos/{prestamo}/devolver', [PrestamoController::class, 'devolver'])->name('prestamos.devolver');
