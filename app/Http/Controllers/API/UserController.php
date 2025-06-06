<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        return User::create($validated);
    }

    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        return $user;
    }

    public function destroy($id)
    {
        return User::destroy($id);
    }

    public function recuperarContrasena(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users,email',
    ]);

    $user = User::where('email', $request->email)->first();

    $nuevaClave = Str::random(8); // genera algo como "a9js7kz2"
    $user->password = bcrypt($nuevaClave);
    $user->save();

    Mail::raw("Tu nueva contraseña es: $nuevaClave", function ($message) use ($user) {
        $message->to($user->email)
                ->subject('Recuperación de contraseña');
    });

    return response()->json(['message' => 'Contraseña enviada al correo'], 200);
}


    public function aceptarTerminos(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->acepto_terminos = true;
        $user->save();

        return response()->json([
            'message' => 'Términos aceptados correctamente.',
            'user' => $user
        ]);
    }

}

