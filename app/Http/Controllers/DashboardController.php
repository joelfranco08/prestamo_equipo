<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Equipo;
use App\Models\Prestamo;

class DashboardController extends Controller
{
    public function index()
    {
        $disponibles = Equipo::where('estado', 'Disponible')->count();
        $prestados = Equipo::where('estado', 'Prestado')->count();
        $totalPrestamos = Prestamo::count();
        $vencidos = 0; // O tu lógica de vencidos

        return view('dashboard', compact('disponibles', 'prestados', 'totalPrestamos', 'vencidos'));
    }
}
