<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/estudiante/nuevo', function () {
    return view('estudiante/crear');
})->name('nuevoEstudiante');
Route::get('/estudiantes', [App\Http\Controllers\EstudianteController::class, 'index'])->name('listarEstudiantes');
Route::get('/estudiantes/nuevos', [App\Http\Controllers\EstudianteController::class, 'getEstudiantesNuevos'])->name('listarEstudiantesNuevos');
Route::get('/estudiante/{id}', [App\Http\Controllers\EstudianteController::class, 'show'])->name('showEstudiante');
Route::get('/estudiante/{id}/editar', [App\Http\Controllers\EstudianteController::class, 'edit'])->name('showEditar');
Route::get('/estudiante/{id}/pagos', [App\Http\Controllers\EstudianteController::class, 'pagos'])->name('pagos');
