<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use App\Mail\AsistenciaNotificacion;
use App\Models\Apoderado;
use App\Models\Asistencia;
use App\Models\Grupo;
use App\Models\GrupoAlumno;
use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class RegistroController extends Controller
{
    public function create(Grupo $grupo)
    {
        $alumnos = $grupo->alumnos;
        // return $alumnos;

        $user = Auth::user();

        // Verificar que el grupo pertenece al docente y el periodo está activo
        if (!$grupo->docentes()->where('user_id', $user->id)->exists() || $grupo->periodo->estado !== 'activo') {
            abort(403, 'No tienes acceso a este grupo.');
        }

        return view('docente.registros.create', compact('grupo', 'alumnos'));
    }

    public function store(Request $request, Grupo $grupo)
    {
        // Crear un nuevo registro de asistencia
        $registro = Registro::create([
            'grupo_id' => $grupo->id,
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'informe' => $request->has('informe'),
        ]);

        // Iterar sobre las asistencias enviadas
        foreach ($request->asistencias as $alumno_id => $asistio) {
            // Obtener el grupo_alumno_id correcto
            $grupoAlumno = DB::table('grupo_alumnos')
                ->where('grupo_id', $grupo->id)
                ->where('alumno_id', $alumno_id)
                ->first();

            if (!$grupoAlumno) {
                continue; // Si no existe el grupo_alumno, saltamos al siguiente
            }

            // Crear el registro de asistencia
            $asistencia = Asistencia::create([
                'registro_id' => $registro->id,
                'grupo_alumno_id' => $grupoAlumno->id,
                'asistio' => $asistio,
            ]);

            // Obtener los datos del alumno
            $alumno = DB::table('alumnos')->where('id', $alumno_id)->first();

            // Obtener los datos del curso
            $curso = DB::table('cursos')
                ->join('grupos', 'grupos.curso_id', '=', 'cursos.id')
                ->where('grupos.id', $grupo->id)
                ->select('cursos.nombre as curso_nombre')
                ->first();

            // Obtener los apoderados del alumno
            $apoderados = DB::table('apoderados')
                ->join('users', 'users.id', '=', 'apoderados.user_id')
                ->where('apoderados.alumno_id', $alumno->id)
                ->select('users.email', 'users.name as apoderado_nombre')
                ->get();

            // Determinar el estado de asistencia
            $estado = '';
            $diseno = '';
            switch ($asistio) {
                case 'p':
                    $estado = 'asistió';
                    $diseno = 'success';
                    break;
                case 'f':
                    $estado = 'faltó';
                    $diseno = 'danger';
                    break;
                case 't':
                    $estado = 'llegó tarde';
                    $diseno = 'warning';
                    break;
                case 'j':
                    $estado = 'faltó justificadamente';
                    $diseno = 'info';
                    break;
            }
            /*
            // Encabezado del correo
            $encabezado = "{$alumno->nombres} {$estado} al curso de {$curso->curso_nombre}";

            // Enviar el correo a cada apoderado
            foreach ($apoderados as $apoderado) {
                $correo = new AsistenciaNotificacion($alumno, $curso, $apoderado, $registro->fecha, $estado, $diseno, $encabezado);
                Mail::to($apoderado->email)->send($correo);
            }
            */
        }

        return redirect()->route('docente.grupos.show', $grupo);
    }



    public function edit(Registro $registro)
    {
        $user = Auth::user();
        $grupo = $registro->grupo;
        $asistencias = $registro->asistencias()->with('grupoAlumno.alumno')->get();

        // Verificar que el grupo pertenece al docente y el periodo está activo
        if (!$grupo->docentes()->where('user_id', $user->id)->exists() || $grupo->periodo->estado !== 'activo') {
            abort(403, 'No tienes acceso a este grupo.');
        }

        // Ordena las asistencias por el apellido paterno del alumno
        $asistencias = $asistencias->sortBy(function ($asistencia) {
            return $asistencia->grupoAlumno->alumno->apellido_paterno;
        });

        return view('docente.registros.edit', compact('registro', 'grupo', 'asistencias'));
    }

    public function update(Request $request, Registro $registro)
    {
        $registro->update([
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'informe' => $request->has('informe'),
        ]);

        foreach ($request->asistencias as $id => $asistio) {
            $asistencia = Asistencia::findOrFail($id);
            $asistencia->update(['asistio' => $asistio]);
        }

        return redirect()->route('docente.grupos.show', $registro->grupo);
    }

    public function destroy(Registro $registro)
    {
        $registro->delete();
        return redirect()->back();
    }
}
