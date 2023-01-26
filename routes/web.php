<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/estudiante/nuevo', [App\Http\Controllers\EstudianteController::class, 'showCrear'])->name('nuevoEstudiante');
    Route::post('/estudiante/crear', [App\Http\Controllers\EstudianteController::class, 'create'])->name('crearEstudiante');
    Route::post('/estudiante/update/{id}', [App\Http\Controllers\EstudianteController::class, 'update'])->name('updateEstudiante');

    Route::get('/estudiantes', [App\Http\Controllers\EstudianteController::class, 'index'])->name('listarEstudiantes');
    Route::get('/estudiantes/nuevos', [App\Http\Controllers\EstudianteController::class, 'getEstudiantesNuevos'])->name('listarEstudiantesNuevos');
    Route::get('/estudiantes/{id}', [App\Http\Controllers\EstudianteController::class, 'show'])->name('showEstudiante');
    Route::get('/estudiantes/{id}/pagos', [App\Http\Controllers\EstudianteController::class, 'pagos'])->name('pagosEstudiante');
    Route::post('/estudiantes/{id}/registrar-pago', [App\Http\Controllers\EstudianteController::class, 'registrarPago'])->name('registrarPago');
    Route::get('/estudiantes/{id}/editar', [App\Http\Controllers\EstudianteController::class, 'edit'])->name('showEditar');

    Route::prefix('registros')->group(function () {
        Route::get('/subir', function () {
            return view('Registros.Subir');
        })->name('subidaMasiva');
        Route::post('/subir', [EstudianteController::class, 'storeMassive'])->name('subirReg');
    });
});
