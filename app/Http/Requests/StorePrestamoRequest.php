<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePrestamoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool { return true; }
    public function rules(): bool|array
    {
      return [
            'equipo_id' => [
                'required',
                'exists:equipos,id',
                function ($attribute, $value, $fail) {
                    // MEJORA: Validación de negocio en tiempo real
                    $equipo = Equipo::find($value);
                    if ($equipo && $equipo->estado !== 'Disponible') {
                        $fail('El equipo seleccionado no se encuentra Disponible en este momento.');
                    }
                },
            ],
            'solicitante_id' => 'required|exists:solicitantes,id',
            'fecha_prestamo' => 'required|date|after_or_equal:today',
            'fecha_devolucion_esperada' => 'required|date|after:fecha_prestamo',
            'observaciones_entrega' => 'nullable|string',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
        ];
    }
}
