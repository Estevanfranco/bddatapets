<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Pqrsd;
use Illuminate\Http\Request;

class PqrsdController extends Controller
{
    public function index()
    {
        return Pqrsd::with('cliente')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'tipo' => 'required|in:Petición,Queja,Reclamo,Sugerencia,Denuncia',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
        ]);

        return Pqrsd::create($request->all());
    }

    public function show(Pqrsd $pqrsd)
    {
        return $pqrsd->load('cliente');
    }

    public function update(Request $request, Pqrsd $pqrsd)
    {
        $request->validate([
            'cliente_id' => 'required|exists:clientes,id',
            'tipo' => 'required|in:Petición,Queja,Reclamo,Sugerencia,Denuncia',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
        ]);

        $pqrsd->update($request->all());
        return $pqrsd;
    }

    public function destroy(Pqrsd $pqrsd)
    {
        $pqrsd->delete();
        return response()->noContent();
    }
}
