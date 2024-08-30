<?php

use App\Http\Controllers\Apoderado\AlumnoController;
use App\Http\Controllers\Apoderado\AsistenciaController;
use App\Http\Controllers\Apoderado\GrupoController;
use App\Http\Controllers\Apoderado\RepresentadoController;
use Illuminate\Support\Facades\Route;

Route::prefix('alumnos')->name('apoderado.alumnos.')->controller(AlumnoController::class)->group(function () {
    Route::get('search', 'showSearchForm')->name('searchForm');
    Route::post('search', 'searchAlumno')->name('search');
    Route::get('{alumno}/add-apoderado', 'addApoderado')->name('addApoderado');
});

Route::prefix('representados')->name('apoderado.representados.')->group(function () {
    Route::get('/', [RepresentadoController::class, 'index'])->name('index');
    Route::delete('/{alumno}', [RepresentadoController::class, 'destroy'])->name('destroy');
    Route::post('/{alumno}', [RepresentadoController::class, 'downloadQR'])->name('downloadQR');
    Route::get('/{alumno}/grupos', [GrupoController::class, 'index'])->name('grupos.index');
    Route::get('/{alumno}/grupos/{grupo}/asistencias', [AsistenciaController::class, 'index'])->name('grupos.asistencias.index');
});
