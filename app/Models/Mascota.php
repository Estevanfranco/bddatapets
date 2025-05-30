<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'nombre',
        'especie',
        'raza',
        'edad',
        'sexo',
        'color',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }
}
