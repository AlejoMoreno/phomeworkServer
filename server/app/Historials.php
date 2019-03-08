<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historials extends Model
{
    protected $fillable = ['fecha',
    'id_profesor',
    'id_estudiante',
    'id_admin'];
}
