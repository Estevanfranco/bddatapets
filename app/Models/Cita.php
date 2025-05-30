<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
protected $fillable = [
    'cliente_id',
    'nombre_mascota',
    'fecha',
    'hora',
    'motivo',
    'estado'
];
}
