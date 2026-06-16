<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class solicitante extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['nombre', 'documento', 'correo', 'tipo'];

    public function prestamos()
    {
        return $this->hasMany(prestamo::class, 'solicitante_id');
    }
}
