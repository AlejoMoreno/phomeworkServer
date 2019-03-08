<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Administradores extends Model
{
    protected $fillable = ['nombre_admin',
    'cedula',
    'telefono',
    'direccion',
    'clave',
    'correo',
    'estado',
    'idtipo_usuario'];
}
