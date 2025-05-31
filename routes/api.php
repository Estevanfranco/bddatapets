<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PqrdsController;
use App\Http\Controllers\API\ContactoController;


use App\Http\Controllers\Api\CitaController;
use App\Http\Controllers\Api\EmailController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


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