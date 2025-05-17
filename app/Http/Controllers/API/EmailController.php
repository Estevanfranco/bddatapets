<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'tipoPQRDS' => 'required|string',
            'asunto'    => 'required|string|max:150',
            'mensaje'   => 'required|string|max:4000',
        ]);

        // Enviar el correo usando la vista Blade
        Mail::send('emails.correo', $validated, function ($message) use ($validated) {
            $message->to('drago2062@gmail.com') // Cambiar por tu correo real
                    ->subject("Nuevo PQRDS: " . $validated['asunto']);
        });

        return response()->json([
            'success' => 'Correo enviado exitosamente.',
            'code'    => 200,
        ], 200);
    }
}
