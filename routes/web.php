<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InstallationController;

/*
|--------------------------------------------------------------------------
| Rutas de instalación
|--------------------------------------------------------------------------
|
| Estas rutas solo son accesibles cuando la aplicación no está instalada.
|
*/

Route::middleware(['web', 'installation'])->prefix('install')->group(function () {
    Route::get('/', [InstallationController::class, 'welcome'])->name('installation.welcome');
    Route::get('/requirements', [InstallationController::class, 'requirements'])->name('installation.requirements');
    Route::get('/database', [InstallationController::class, 'database'])->name('installation.database');
    Route::post('/database', [InstallationController::class, 'saveDatabase'])->name('installation.database.save');
    Route::get('/user', [InstallationController::class, 'user'])->name('installation.user');
    Route::post('/user', [InstallationController::class, 'saveUser'])->name('installation.user.save');
    Route::get('/finish', [InstallationController::class, 'finish'])->name('installation.finish');
    Route::post('/finish', [InstallationController::class, 'saveFinish'])->name('installation.finish.save');
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});