<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEquipoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // <-- Recuerda dejarlo en true para que te permita usarlo
    }

    public function rules(): array
    {
        // Buscamos el parámetro de la ruta de forma segura
        $equipoParam = $this->route('equipo') ?? $this->route('id');

        // Si es el objeto completo, extraemos solo el número ID
        $equipoId = is_object($equipoParam) ? $equipoParam->id : $equipoParam;

        return [
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
