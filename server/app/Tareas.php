<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tareas extends Model
{
    protected $fillable = ['nombre',
    'urltarea',
    'calificacion',
    'estado',
    'idestudiante',
    'valor',
    'descripcion',
    'fecha_creacion',
    'fecha_vencimiento',
    'idprofesor'];
}
