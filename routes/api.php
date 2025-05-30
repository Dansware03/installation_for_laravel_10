<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Rutas públicas
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas
Route::middleware('auth:sanctum')->group(function () {
    // Información del usuario autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    
    // Cerrar sesión
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Rutas solo para administradores root
    Route::middleware('role:root')->group(function () {
        Route::apiResource('users', UserController::class);
    });
});
