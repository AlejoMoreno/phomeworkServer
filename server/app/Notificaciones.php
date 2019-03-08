<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notificaciones extends Model
{
    protected $fillable = ['titulo',
    'texto',
    'estudiante',
    'docente',
    'fecha_creado',
    'fecha_actualizado',
    'estado'];
}
