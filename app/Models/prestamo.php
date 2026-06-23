<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    use HasFactory;

protected $fillable = [
        'equipo_id',
        'solicitante_id',
        'fecha_prestamo',
        'fecha_devolucion_esperada', // <-- Asegúrate de que tenga el nombre largo aquí
        'fecha_devolucion_real',
        'observaciones_entrega'
    ];

    // Relación con el Equipo (Esta suele estar bien, pero revísala)
// CORRECCIÓN CRÍTICA: Debe ser belongsTo, NO hasMany
    public function equipo()
    {
        return $this->belongsTo(Equipo::class);
    }

    // CORRECCIÓN CRÍTICA: Debe ser belongsTo, NO hasMany
    public function solicitante()
    {
        return $this->belongsTo(Solicitante::class);
    }
}
