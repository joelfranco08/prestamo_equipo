<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $fillable = [
        'equipo_id',
        'solicitante_id',
        'fecha_prestamo',
        'fecha_devolucion_esperada',
        'fecha_devolucion_real',
        'observaciones_entrega',
        'observaciones_devolucion'
    ]; // <-- AQUÍ DEBE IR UN PUNTO Y COMA (;), NO UNA LLAVE DE CIERRE (})

    protected $casts = [
        'fecha_prestamo' => 'date',
        'fecha_devolucion_esperada' => 'date',
        'fecha_devolucion_real' => 'date',
    ];

    public function equipo()
    {
        return $this->belongsTo(Equipo::class, 'equipo_id')->withTrashed();
    }

    public function solicitante()
    {
        return $this->belongsTo(Solicitante::class, 'solicitante_id')->withTrashed();
    }
} // <-- LA LLAVE DE CIERRE DE LA CLASE VA AL FINAL DE TODO EL ARCHIVO
//(Nota el uso de withTrashed(): permite que si un equipo se elimina lógicamente,
//  el préstamo viejo siga mostrando qué equipo era).
