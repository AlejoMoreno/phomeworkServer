<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estudiantes extends Model
{
    protected $fillable = ['nickname',
    'edad',
    'telefono',
    'correo',
    'clave',
    'PAYER_DNI',
    'tipo',
    'tokens'];
}
