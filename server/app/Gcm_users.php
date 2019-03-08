<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gcm_users extends Model
{
    protected $fillable = ['gcm_regid',
    'name',
    'email'];
}
