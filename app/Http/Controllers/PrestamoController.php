<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Equipo;
use App\Models\Solicitante;
use App\Http\Requests\StorePrestamoRequest;
use Illuminate\Http\Request;

class PrestamoController extends Controller
{
    public function index()
    {
        // Eager Loading para evitar el problema de consulta N+1
        $prestamos = Prestamo::with(['equipo', 'solicitante'])->orderBy('id', 'desc')->get();
        return view('prestamos.index', compact('prestamos'));
    }

    public function create()
    {
        $equipos = Equipo::where('estado', 'Disponible')->get();
        $solicitantes = Solicitante::all();
        return view('prestamos.create', compact('equipos', 'solicitantes'));
    }

    public function store(StorePrestamoRequest $request)
    {
        // 1. Registrar préstamo
        Prestamo::create($request->validated());

        // 2. Transición automática de Estado (Requerimiento 3)
        $equipo = Equipo::find($request->equipo_id);
        $equipo->update(['estado' => 'Prestado']);

        return redirect()->route('prestamos.index')->with('success', 'Préstamo procesado con éxito.');
    }

    public function devolver(Request $request, Prestamo $prestamo)
    {
        $request->validate(['observaciones_devolucion' => 'nullable|string']);

        // 1. Registrar devolución real (Requerimiento 4)
        $prestamo->update([
            'fecha_devolucion_real' => now(),
            'observaciones_devolucion' => $request->observaciones_devolucion
        ]);

        // 2. Regresar equipo a disponible
        $prestamo->equipo->update(['estado' => 'Disponible']);

        return redirect()->route('prestamos.index')->with('success', 'Equipo devuelto e integrado al inventario.');
    }
}
