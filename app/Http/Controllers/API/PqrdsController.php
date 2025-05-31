<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pqrds;

class PqrdsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
        'tipoPQRDS' => 'required|in:Petición,Queja,Reclamo,Denuncia,Sugerencia',
        'asunto' => 'required|string|max:150',
        'mensaje' => 'required|string|max:4000',
    ]);

    $pqrds = Pqrds::create($request->all());

    return response()->json([
        'message' => 'PQRDS enviada exitosamente',
        'data' => $pqrds,
    ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
