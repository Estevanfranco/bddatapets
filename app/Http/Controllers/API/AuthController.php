<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:6',
    ]);

    // 🎯 Acá personalizás el mensaje del campo "email"
    $validator->setCustomMessages([
        'email.unique' => 'Este correo ya está en uso. Por favor prueba con otro.',
    ]);

    if ($validator->fails()) {
        return response()->json([
            'message' => 'Errores de validación',
            'errors' => $validator->errors()
        ], 422);
    }

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return response()->json(['message' => 'Usuario registrado exitosamente', 'user' => $user]);
}

    public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();
        return response()->json([
            'message' => 'Login correcto',
            'user' => [

                'name' => $user->name,
                'email' => $user->email,
                 'id' => $user->id
            ]
            
        ]);
    }

    return response()->json(['message' => 'Credenciales incorrectas'], 401);
    
}


public function update(Request $request, $id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'Usuario no encontrado'], 404);
    }

    $validator = Validator::make($request->all(), [
        'name' => 'string|max:255',
        'email' => 'string|email|max:255|unique:users,email,' . $id,
        'password' => 'nullable|string|min:6',
        'telefono' => 'nullable|string|max:20' // Solo si manejas ese campo en la tabla
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $user->name = $request->name ?? $user->name;
    $user->email = $request->email ?? $user->email;

    if ($request->filled('password')) {
        $user->password = Hash::make($request->password);
    }

    if ($request->has('telefono')) {
        $user->telefono = $request->telefono;
    }

    $user->save();

    return response()->json(['message' => 'Usuario actualizado correctamente', 'user' => $user]);
}



}
