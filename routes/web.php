<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipoController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\SolicitanteController; // <-- Revisa que esta línea esté escrita

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

// Esta línea es la que CREA 'solicitantes.index' de forma automática:
Route::resource('solicitantes', SolicitanteController::class);

Route::resource('equipos', EquipoController::class);
Route::resource('prestamos', PrestamoController::class);
// Asegúrate de tener esta línea exacta para procesar la devolución
Route::post('/prestamos/{id}/devolver', [PrestamoController::class, 'devolver'])->name('prestamos.devolver');
