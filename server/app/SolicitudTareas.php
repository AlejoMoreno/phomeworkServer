<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SolicitudTareas extends Model
{
    protected $fillable = ['id_docente',
    'id_tarea',
    'fecha',
    'aceptado'];
}
