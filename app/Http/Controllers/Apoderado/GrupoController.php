<?php

namespace App\Http\Controllers\Apoderado;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use Illuminate\Support\Facades\DB;

// use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index(Alumno $alumno)
    {
        // Obtener el usuario actualmente autenticado
        $user = auth()->user();

        // Verificar si el usuario está vinculado con el alumno
        $vinculado = DB::table('apoderados')
            ->where('user_id', $user->id)
            ->where('alumno_id', $alumno->id)
            ->exists();

        // Si no está vinculado, redirigir o mostrar error
        if (!$vinculado) {
            abort(403, 'No tienes permisos.');
        }

        // Obtener los grupos del alumno para el periodo activo
        $grupos = $alumno->grupos()->whereHas('periodo', function ($query) {
            $query->where('estado', 'activo');
        })->with('curso')->get();

        return view('apoderado.grupos.index', compact('alumno', 'grupos'));
    }
}
