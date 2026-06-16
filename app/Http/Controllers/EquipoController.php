<?php



namespace App\Http\Controllers;

use App\Models\Equipo;
use Illuminate\Http\Request;
use App\Http\Requests\StoreEquipoRequest;
use App\Http\Requests\UpdateEquipoRequest; // <-- REVISA QUE DIGA App\Http\Requests (en plural)
class EquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
    {
        // MEJORA: Query Builder dinámico para el buscador solicitado
        $buscar = $request->input('buscar');
        $equipos = Equipo::when($buscar, function ($query, $buscar) {
            return $query->where('nombre', 'LIKE', "%{$buscar}%")
                         ->orWhere('codigo', 'LIKE', "%{$buscar}%");
        })->paginate(10);

        return view('equipos.index', compact('equipos'));
    }

    /**
     * Show the form for creating a new resource.
     */
 public function create() { return view('equipos.create'); }

    /**
     * Store a newly created resource in storage.
     */
public function store(StoreEquipoRequest $request)
{
    Equipo::create($request->validated());
    return redirect()->route('equipos.index')->with('success', 'Equipo registrado con éxito.');
}
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
  public function edit(Equipo $equipo) { return view('equipos.edit', compact('equipo')); }
    /**
     * Update the specified resource in storage.
     */
/**
 * Update the specified resource in storage.
 */
public function update(\Illuminate\Http\Request $request, string $id) // <-- Se queda con $id, está bien
{
   
// 1. Validamos los datos que vienen del formulario (SIN ESPACIOS EN LAS REGLAS)
    $datosValidados = $request->validate([
        'codigo' => [
            'required',
            'string',
            \Illuminate\Validation\Rule::unique('equipos', 'codigo')->ignore($id),
        ],
        'nombre'    => 'required|string|max:100',
        'categoria' => 'required|string',
        'marca'     => 'required|string',
        'estado'    => 'required|in:Disponible,Prestado,Mantenimiento', // <-- FIJATE AQUÍ: Todo pegadito, sin espacios
    ]);

    // 2. ⚠️ ¡ESTA LÍNEA ES LA QUE TE FALTA! Buscamos el equipo en la base de datos usando el $id
    $equipo = \App\Models\Equipo::findOrFail($id);

    // 3. Ahora que $equipo sí existe, guardamos los datos validados
    $equipo->update($datosValidados);

    // 4. Redirección con mensaje de éxito
    return redirect()->route('equipos.index')->with('success', 'Equipo actualizado correctamente.');
}
    /**
     * Remove the specified resource from storage.
     */
 public function destroy(Equipo $equipo)
    {
        $equipo->delete();
        return redirect()->route('equipos.index')->with('success', 'Equipo enviado a la papelera (Historial conservado).');
    }
}
