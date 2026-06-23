<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePrestamoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Asegúrate de que esté en true para que te permita guardar
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
  public function rules(): array
    {
        return [
            'equipo_id' => 'required|exists:equipos,id',
            'solicitante_id' => 'required|exists:solicitantes,id',
            'fecha_prestamo' => 'required|date',
            'fecha_dev_esperada' => 'required|date|after_or_equal:fecha_prestamo',
            'observaciones_entrega' => 'nullable|string|max:500',
        ];
    }
}
