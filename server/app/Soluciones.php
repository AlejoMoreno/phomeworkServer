<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Soluciones extends Model
{
    protected $fillable = ['notificacion',
    'idtareas',
    'idestudiante',
    'idprofesores',
    'fecha'];
}
