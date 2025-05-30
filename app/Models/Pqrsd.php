<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pqrsd extends Model
{
    protected $fillable = ['cliente_id', 'tipo', 'descripcion', 'fecha'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}

