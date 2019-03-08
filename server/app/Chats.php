<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chats extends Model
{
    protected $fillable = ['idestudiante',
    'idprofesor',
    'mensaje',
    'fecha',
    'estado',
    'vs'];
}
