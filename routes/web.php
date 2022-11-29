<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudianteController;
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

Route::get('/estudiante/nuevo', [App\Http\Controllers\EstudianteController::class, 'showCrear'])->name('nuevoEstudiante');
Route::post('/estudiante/crear', [App\Http\Controllers\EstudianteController::class, 'create'])->name('crearEstudiante');

Route::get('/estudiantes', [App\Http\Controllers\EstudianteController::class, 'index'])->name('listarEstudiantes');
Route::get('/estudiantes/nuevos', [App\Http\Controllers\EstudianteController::class, 'getEstudiantesNuevos'])->name('listarEstudiantesNuevos');
Route::get('/estudiante/{id}', [App\Http\Controllers\EstudianteController::class, 'show'])->name('showEstudiante');
Route::get('/estudiante/{id}/editar', [App\Http\Controllers\EstudianteController::class, 'edit'])->name('showEditar');
Route::get('/estudiante/{id}/pagos', [App\Http\Controllers\EstudianteController::class, 'pagos'])->name('pagos');
Route::prefix('registros')->group(function () {
    Route::get('/subir', function () {
        return view('Registros.Subir');
    })->name('subidaMasiva');
    Route::post('/subir',[EstudianteController::class,'storeMassive'])->name('subirReg');
});