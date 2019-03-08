<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profesores extends Model
{
    protected $fillable = ['nombre',
    'apellido',
    'urlFoto',
    'correo',
    'telefono',
    'direccion',
    'urlCertificado',
    'estado',
    'idadministrador',
    'idareasEspecialista',
    'clave',
    'descripcion',
    'tipo',
    'cuenta',
    'tipocuenta',
    'banco'];
}
