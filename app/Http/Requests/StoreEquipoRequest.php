<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule; // <-- ASEGÚRATE DE IMPORTAR ESTA CLASE ARRIBA

class StoreEquipoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Conseguimos el ID del equipo directamente desde el parámetro de la ruta
        // Si tu ruta es /equipos/{equipo}, esto extraerá el número '1'
        $equipoId = $this->route('equipo');

        // Si $equipoId devuelve el objeto modelo en lugar del número ID, extraemos el id numérico
        if (is_object($equipoId)) {
            $equipoId = $equipoId->id;
        }

        return [
            // Usamos Rule::unique para ignorar el ID actual de manera completamente limpia:
            'codigo' => [
                'required',
                'string',
                Rule::unique('equipos', 'codigo')->ignore($equipoId),
            ],
            'nombre' => 'required|string|max:100',
            'categoria' => 'required|string',
            'marca' => 'required|string',
            'estado' => 'required|in:Disponible,Prestado,Mantenimiento',
        ];
    }
}
