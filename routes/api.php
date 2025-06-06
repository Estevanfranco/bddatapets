<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PqrdsController;
use App\Http\Controllers\API\ContactoController;


use App\Http\Controllers\Api\CitaController;
use App\Http\Controllers\Api\EmailController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ClienteController; 
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\API\MascotaController;
use App\Http\Controllers\API\PqrsdController;
// Rutas de clientes
Route::prefix('clientes')->group(function () {
    Route::get('/', [ClienteController::class, 'index']);       // Listar todos los clientes
    Route::post('/', [ClienteController::class, 'store']);      // Crear cliente
    Route::get('/{id}', [ClienteController::class, 'show']);    // Mostrar un cliente
    Route::put('/{id}', [ClienteController::class, 'update']);  // Actualizar cliente
    Route::delete('/{id}', [ClienteController::class, 'destroy']); // Eliminar cliente
});

// Usuario autenticado
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Rutas adicionales
Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('users', UserController::class);
Route::post('/recuperar', [UserController::class, 'recuperarContrasena']);
Route::apiResource('clientes', ClienteController::class); // ← Este también usa ClienteController
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::put('/users/{id}', [AuthController::class, 'update']);
Route::post('/EnviarCorreo', [EmailController::class, 'index']);



Route::get('/citas', [CitaController::class, 'index']);
Route::post('/citas', [CitaController::class, 'store']);
Route::put('/citas/{id}', [CitaController::class, 'update']);
Route::delete('/citas/{id}', [CitaController::class, 'destroy']);

Route::resource('contacto', ContactoController::class);
Route::resource('pqrds', PqrdsController::class);

Route::put('/users/{id}/aceptar-terminos', [UserController::class, 'aceptarTerminos']);
