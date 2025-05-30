<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
  protected $fillable = ['foto', 'nombre', 'correo', 'telefono'];
}
