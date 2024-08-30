<?php

namespace App\Http\Controllers\Apoderado;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Asistencia;
use App\Models\Grupo;
use Illuminate\Support\Facades\DB;

// use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function index(Alumno $alumno, Grupo $grupo)
    {
        // Obtener el usuario actualmente autenticado
        $user = auth()->user();

        // Verificar si está matriculado
        $matriculado = DB::table('grupo_alumnos')
            ->where('grupo_id', $grupo->id)
            ->where('alumno_id', $alumno->id)
            ->exists();

        // Si no está matriculado, redirigir o mostrar error
        if (!$matriculado) {
            abort(403, 'Ha ocurrido un error.');
        }

        // Verificar si el periodo es actual
        if ($grupo->periodo->estado !== 'activo') {
            abort(403, 'Periodo fuera de fecha.');
        }

        // Verificar si el usuario está vinculado con el alumno
        $vinculado = DB::table('apoderados')
            ->where('user_id', $user->id)
            ->where('alumno_id', $alumno->id)
            ->exists();

        // Si no está vinculado, redirigir o mostrar error
        if (!$vinculado) {
            abort(403, 'No tienes permisos.');
        }

        $asistencias = Asistencia::select('asistencias.*')
            ->join('registros', 'asistencias.registro_id', '=', 'registros.id')
            ->whereHas('grupoAlumno', function ($query) use ($grupo, $alumno) {
                $query->where('grupo_id', $grupo->id)
                    ->where('alumno_id', $alumno->id);
            })
            ->orderBy('registros.fecha', 'desc')
            ->orderBy('registros.hora', 'desc')
            ->get();

        $curso = $grupo->curso;
        $grado = $grupo->grado;
        $periodo = $grupo->periodo;

        return view('apoderado.asistencias.index', compact(
            'alumno',
            'grupo',
            'curso',
            'asistencias',
            'curso',
            'grado',
            'periodo',
        ));
    }
}
