<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mensajes extends Model
{
    protected $fillable = ['alias',
    'mensaje',
    'ip',
    'fecha',
    'admin'];
}
