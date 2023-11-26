<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\estudianteController;
use App\Http\Controllers\Api\profesorController;
use App\Http\Controllers\Api\asignaturaController;
use App\Http\Controllers\Api\reporteController;

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

Route::get('estudiantes', [estudianteController::class, 'index']);
Route::post('estudiantes', [estudianteController::class, 'Universidad']);
Route::get('estudiantes/{id}', [estudianteController::class, 'show']);
Route::get('estudiantes/{id}/edit', [estudianteController::class, 'edit']);
Route::put('estudiantes/{id}/edit', [estudianteController::class, 'update']);
Route::delete('estudiantes/{id}/delete', [estudianteController::class, 'destroy']);

Route::get('profesores', [profesorController::class, 'indexProfesores']);
Route::post('profesores', [profesorController::class, 'UniversidadProfesores']);
Route::get('profesores/{id}', [profesorController::class, 'showProfesores']);
Route::get('profesores/{id}/edit', [profesorController::class, 'editProfesores']);
Route::put('profesores/{id}/edit', [profesorController::class, 'updateProfesores']);
Route::delete('profesores/{id}/delete', [profesorController::class, 'destroyProfesores']);

Route::get('asignaturas', [asignaturaController::class, 'indexAsignaturas']);
Route::post('asignaturas', [asignaturaController::class, 'UniversidadAsignaturas']);
Route::get('asignaturas/{id}', [asignaturaController::class, 'showAsignaturas']);
Route::get('asignaturas/{id}/edit', [asignaturaController::class, 'editAsignaturas']);
Route::put('asignaturas/{id}/edit', [asignaturaController::class, 'updateAsignaturas']);
Route::delete('asignaturas/{id}/delete', [asignaturaController::class, 'destroyAsignaturas']);

Route::get('reportes', [reporteController::class, 'indexReportes']);
Route::post('reportes', [reporteController::class, 'UniversidadReportes']);
Route::get('reportes/{id}', [reporteController::class, 'showReportes']);
Route::get('reportes/{id}/edit', [reporteController::class, 'editReportes']);
Route::put('reportes/{id}/edit', [reporteController::class, 'updateReportes']);
Route::delete('reportes/{id}/delete', [reporteController::class, 'destroyReportes']);



