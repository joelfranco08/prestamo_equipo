<?php

namespace App\Http\Controllers;

use App\Models\Prestamo;
use App\Models\Equipo;
use App\Models\Solicitante;
use App\Http\Requests\StorePrestamoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrestamoController extends Controller
{
 public function index()
    {
        // Trae los préstamos cargando sus relaciones individuales
        $prestamos = Prestamo::with(['equipo', 'solicitante'])->latest('id')->get();

        return view('prestamos.index', compact('prestamos'));
    }

  public function create()
{
    // Solo mandamos a la vista los equipos que estén libres
    $equipos = Equipo::where('estado', 'Disponible')->get();
    $solicitantes = Solicitante::all();

    return view('prestamos.create', compact('equipos', 'solicitantes'));
}
   public function store(StorePrestamoRequest $request)
    {
        DB::transaction(function () use ($request) {
            $equipo = Equipo::findOrFail($request->equipo_id);

            // COMENTA ESTAS LÍNEAS agregando // al inicio:
            // if ($equipo->estado !== 'Disponible') {
            //     abort(422, 'El equipo seleccionado ya no está disponible.');
            // }

            // 2. Insertamos el registro
          Prestamo::create([
                'equipo_id'                 => $request->input('equipo_id'),
                'solicitante_id'            => $request->input('solicitante_id'),
                'fecha_prestamo'            => $request->input('fecha_prestamo'),
                'fecha_devolucion_esperada' => $request->input('fecha_dev_esperada'), // <-- AQUÍ: La columna real es fecha_devolucion_esperada
                'observaciones_entrega'     => $request->input('observaciones_entrega'),
            ]);

            // 3. Cambiamos automáticamente el estado del equipo a Prestado
            $equipo->update(['estado' => 'Prestado']);
        });

        return redirect()->route('prestamos.index')->with('success', 'Préstamo procesado con éxito y equipo actualizado.');
    }

    // OJO: El método DEBE ir aquí adentro, antes de que se cierre la clase
 public function devolver(Request $request, $id)
{
    DB::transaction(function () use ($id) {
        // 1. Buscamos el préstamo activo
        $prestamo = Prestamo::findOrFail($id);

        // 2. Registramos la fecha de devolución real (hoy)
        $prestamo->update([
            'fecha_devolucion_real' => now()->format('Y-m-d'),
        ]);

        // 3. ¡Liberamos el hardware automáticamente!
        $prestamo->equipo->update([
            'estado' => 'Disponible'
        ]);
    });

    return redirect()->route('prestamos.index')->with('success', 'Equipo recibido con éxito. Su estado ha cambiado a Disponible.');
}
} // <-- Esta es la ÚLTIMA llave que cierra la clase completa. ¡No debe quedar nada abajo de ella!
