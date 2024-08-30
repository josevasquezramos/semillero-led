<?php

use App\Livewire\Grupos;
use App\Livewire\Alumnos;
use App\Livewire\Cursos;
use App\Livewire\GestionarGrupoAlumnos;
use App\Livewire\Grados;
use App\Livewire\Periodos;
use Illuminate\Support\Facades\Route;

Route::get('cursos', Cursos::class)->name('admin.cursos');
Route::get('alumnos', Alumnos::class)->name('admin.alumnos');
Route::get('grados', Grados::class)->name('admin.grados');
Route::get('periodos', Periodos::class)->name('admin.periodos');
Route::get('grupos', Grupos::class)->name('admin.grupos');
Route::get('grupos/{grupo}', GestionarGrupoAlumnos::class)->name('admin.grupos.gestionar');
