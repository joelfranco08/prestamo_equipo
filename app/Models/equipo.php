<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    // Asegúrate de que 'estado' esté dentro de esta lista:
    protected $fillable = [
        'codigo',
        'nombre',
        'categoria',
        'marca',
        'estado'
    ];
}
