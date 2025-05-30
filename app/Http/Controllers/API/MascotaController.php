<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Mascota;
use Illuminate\Http\Request;

class MascotaController extends Controller
{
    public function index()
    {
        return Mascota::with('cliente')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'nombre' => 'required|string',
            'especie' => 'required|string',
            'raza' => 'nullable|string',
            'edad' => 'nullable|integer',
            'sexo' => 'nullable|string|in:macho,hembra',
            'color' => 'nullable|string',
        ]);

        return Mascota::create($request->all());
    }

    public function show(Mascota $mascota)
    {
        return $mascota->load('cliente');
    }

    public function update(Request $request, Mascota $mascota)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'nombre' => 'required|string',
            'especie' => 'required|string',
            'raza' => 'nullable|string',
            'edad' => 'nullable|integer',
            'sexo' => 'nullable|string|in:macho,hembra',
            'color' => 'nullable|string',
        ]);

        $mascota->update($request->all());
        return $mascota;
    }

    public function destroy(Mascota $mascota)
    {
        $mascota->delete();
        return response()->noContent();
    }
}
