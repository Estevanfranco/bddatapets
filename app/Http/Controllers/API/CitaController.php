<?php

// app/Http/Controllers/CitaController.php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CitaController extends Controller
{
    public function index()
    {
        return Cita::all();
    }

    public function store(Request $request)
   {
     $request->validate([
        'cliente_id' => 'required|exists:clientes,id',
        'nombre_mascota' => 'required|string',
        'fecha' => 'required|date',
        'hora' => 'required',
        'motivo' => 'nullable|string',
        'estado' => 'required|in:pendiente,confirmada,cancelada'
     ]);

     return Cita::create($request->all());
   }


    public function show(Cita $cita)
    {
        return $cita;
    }

    public function update(Request $request, Cita $cita)
   {
      $request->validate([
        'cliente_id' => 'required|exists:clientes,id',
        'nombre_mascota' => 'required|string',
        'fecha' => 'required|date',
        'hora' => 'required',
        'motivo' => 'nullable|string',
        'estado' => 'required|in:pendiente,confirmada,cancelada'
      ]);

        $cita->update($request->all());

       return $cita;
    }


    public function destroy(Cita $cita)
    {
        if ($cita->foto) {
            Storage::disk('public')->delete($cita->foto);
        }

        $cita->delete();

        return response()->noContent();
    }
}


