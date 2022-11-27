<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/estudiante/crear', [App\Http\Controllers\EstudianteController::class, 'create'])->name('crearEstudiante');

Route::prefix('registros')->group(function () {
    Route::post('/subir',[EstudianteController::class,'storeMassive'])->name('subirReg');
});