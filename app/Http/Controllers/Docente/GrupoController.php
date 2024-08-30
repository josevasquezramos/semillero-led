<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use App\Models\Grupo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GrupoController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Obtener los grupos del docente donde el periodo está activo
        $grupos = Grupo::with(['curso', 'grado']) // Incluye las relaciones de curso y grado
            ->whereHas('docentes', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->whereHas('periodo', function ($query) {
                $query->where('estado', 'activo');
            })->get();

        // return $grupos;

        return view('docente.grupos.index', compact('grupos'));
    }

    public function show(Grupo $grupo)
    {
        $user = Auth::user();

        // Verificar que el grupo pertenece al docente y el periodo está activo
        if (!$grupo->docentes()->where('user_id', $user->id)->exists() || $grupo->periodo->estado !== 'activo') {
            abort(403, 'No tienes permisos.');
        }

        // Cargar los registros asociados al grupo
        $registros = $grupo->registros()
            ->orderBy('fecha', 'desc')
            ->orderBy('hora', 'desc')
            ->get();

        return view('docente.grupos.show', compact('grupo', 'registros'));
    }
}
