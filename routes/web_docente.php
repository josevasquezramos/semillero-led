<?php

use App\Http\Controllers\Docente\GrupoController;
use App\Http\Controllers\Docente\RegistroController;
use App\Http\Controllers\Docente\ReporteController;
use Illuminate\Support\Facades\Route;

Route::prefix('grupos')->name('docente.grupos.')->group(function () {
    Route::get('/', [GrupoController::class, 'index'])->name('index');
    Route::get('{grupo}', [GrupoController::class, 'show'])->name('show');
});

Route::prefix('grupos/registros')->name('docente.registros.')->group(function () {
    Route::get('create/{grupo}', [RegistroController::class, 'create'])->name('create');
    Route::post('store/{grupo}', [RegistroController::class, 'store'])->name('store');
    Route::get('{registro}/edit', [RegistroController::class, 'edit'])->name('edit');
    Route::put('{registro}', [RegistroController::class, 'update'])->name('update');
    Route::delete('{registro}', [RegistroController::class, 'destroy'])->name('destroy');
});

Route::post('reporte/{grupo}', [ReporteController::class, 'asistenciasPdf'])
    ->name('docente.reporte.asistencias');
