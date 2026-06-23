<?php

namespace App\Http\Controllers;

use App\Models\Solicitante;
use Illuminate\Http\Request;

class SolicitanteController extends Controller
{
    public function index(Request $request)
    {
        // Buscador por nombre o documento (Query Builder)
        $buscar = $request->get('buscar');

        $solicitantes = Solicitante::when($buscar, function ($query, $buscar) {
            return $query->where('nombre', 'LIKE', "%{$buscar}%")
                         ->orWhere('documento', 'LIKE', "%{$buscar}%");
        })->paginate(10);

        return view('solicitantes.index', compact('solicitantes'));
    }

    public function create()
    {
        return view('solicitantes.create');
    }

    public function store(Request $request)
    {
        // Validamos los datos antes de registrar
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'documento' => 'required|string|unique:solicitantes,documento|max:20',
            'correo'    => 'required|email|unique:solicitantes,correo|max:255',
            'tipo'      => 'required|in:Estudiante,Docente', // Solo permite estos dos tipos
        ]);

        Solicitante::create($request->all());

        return redirect()->route('solicitantes.index')->with('success', 'Solicitante registrado con éxito.');
    }
}
