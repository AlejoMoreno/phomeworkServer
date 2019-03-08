<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagos extends Model
{
    protected $fillable = ['idestudiante',
    'valor',
    'signo',
    'saldo',
    'reference_pol',
    'transactionId',
    'responseCode',
    'FIRMA',
    'EMAILPAYER',
    'DESCRIPTION',
    'REFERENCE_CODE',
    'fecha_creation',
    'lapTransactionState'];
}
