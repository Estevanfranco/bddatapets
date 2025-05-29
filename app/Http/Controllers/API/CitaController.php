<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{
    public function index(Request $request)
{
    $userId = $request->query('user_id'); // Recibe como query param
    $citas = Cita::where('user_id', $userId)->get();
    return response()->json($citas);
}

    public function store(Request $request)
{
    $request->validate([
        'mascota' => 'required|string',
        'ciudad' => 'required|string',
        'servicio' => 'required|string',
        'fecha' => 'required|date',
        'user_id' => 'required|exists:users,id',
    ]);

    $cita = Cita::create($request->all());
    return response()->json($cita, 201);
}

    public function update(Request $request, $id)
    {
        $cita = Cita::findOrFail($id);
        $cita->update($request->all());
        return response()->json($cita);
    }

    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();
        return response()->json(['mensaje' => 'Cita eliminada']);
    }
}
