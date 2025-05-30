<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function index()
    {
        return Cliente::all();
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255',
                'correo' => 'required|email|unique:clientes,correo',
                'telefono' => 'nullable|string|max:20',
                'foto' => 'nullable|image|max:2048', // máximo 2MB
            ]);

            if ($request->hasFile('foto')) {
                $validated['foto'] = $request->file('foto')->store('clientes', 'public');
            }
            
            $validated['fecha_registro'] = now(); // agrega la fecha actual manualmente

            $cliente = Cliente::create($validated);

            return response()->json($cliente, 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Devuelve errores de validación detalladamente
            return response()->json(['errors' => $e->errors()], 422);
        }
    }

    public function show($id)
    {
        return Cliente::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'correo' => 'required|email|unique:clientes,correo,' . $id,
            'telefono' => 'nullable|string|max:20',
            'foto' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($cliente->foto) {
                Storage::disk('public')->delete($cliente->foto);
            }

            $validated['foto'] = $request->file('foto')->store('clientes', 'public');
        }

        $cliente->update($validated);

        return response()->json($cliente);
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);

        if ($cliente->foto) {
            Storage::disk('public')->delete($cliente->foto);
        }

        $cliente->delete();

        return response()->json(['mensaje' => 'Cliente eliminado']);
    }
}
