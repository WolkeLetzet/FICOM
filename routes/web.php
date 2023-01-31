<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\BecaController;
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
    Route::prefix('registros')->group(function () {
        Route::get('/subir', function () {
            return view('registros.subir');
        })->name('subidaMasiva');
        
        Route::post('/subir', [EstudianteController::class, 'storeMassive'])->name('subirReg');
    });

    Route::group(['middleware' => ['check.role:admin|contabilidad']], function () {
        Route::get('/estudiantes/{id}/pagos', [EstudianteController::class, 'pagos'])->name('pagosEstudiante');
        Route::post('/estudiantes/{id}/registrar-pago', [EstudianteController::class, 'registrarPago'])->name('registrarPago');
        Route::get('/becas/nueva', [BecaController::class, 'showCreate'])->name('nuevaBeca');
        Route::post('/becas/nueva', [BecaController::class, 'create'])->name('crearBeca');
        Route::get('/becas/{id}/editar', [BecaController::class, 'showEdit'])->name('editBeca');
        Route::post('/becas/{id}/editar', [BecaController::class, 'update'])->name('updateBeca');
    });
    
    Route::group(['middleware' => ['check.role:admin|matriculas']], function () {
        Route::get('/estudiantes/nuevo', [EstudianteController::class, 'showCreate'])->name('nuevoEstudiante');
        Route::post('/estudiantes/crear', [EstudianteController::class, 'create'])->name('crearEstudiante');
        Route::post('/estudiante/update/{id}', [EstudianteController::class, 'update'])->name('updateEstudiante');
    });
    
    Route::get('/becas', [BecaController::class, 'index'])->name('becas');
    Route::get('/becas/{id}', [BecaController::class, 'show'])->name('showBeca');
    Route::get('/estudiantes', [EstudianteController::class, 'index'])->name('listarEstudiantes');
    Route::get('/estudiantes/nuevos', [EstudianteController::class, 'getEstudiantesNuevos'])->name('listarEstudiantesNuevos');
    Route::get('/estudiantes/{id}', [EstudianteController::class, 'show'])->name('showEstudiante');
});
