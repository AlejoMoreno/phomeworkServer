<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $fillable = ['nombre',
    'apellidos',
    'login',
    'password',
    'email',
    'estado',
    'banned',
    'rango'];
}
