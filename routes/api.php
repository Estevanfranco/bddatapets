<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PqrdsController;
use App\Http\Controllers\API\ContactoController;



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::put('/users/{id}', [AuthController::class, 'update']);
Route::post('/EnviarCorreo', [EmailController::class, 'index']);

Route::resource('pqrds', PqrdsController::class);

Route::resource('contacto', ContactoController::class);