<?php

namespace App\Http\Controllers\Docente;

use App\Http\Controllers\Controller;
use App\Models\Grupo;
use App\Models\Registro;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function asistenciasPdf(Grupo $grupo, Request $request)
    {
        // Validar la request para asegurarse de que las fechas sean proporcionadas
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        ]);

        // Verifica si el checkbox está marcado
        $incluirHoras = $request->has('hora');

        // Obtener el rango de fechas de la request
        $fechaInicio = $request->fecha_inicio;
        $fechaFin = $request->fecha_fin;

        // Paso 1: Obtener los registros y agrupar las asistencias por alumno
        $registros = Registro::where('grupo_id', $grupo->id)
            ->whereBetween('fecha', [$fechaInicio, $fechaFin])
            ->with(['asistencias.grupoAlumno.alumno'])
            ->get();

        // Paso 2: Agrupar las asistencias por alumno
        $asistenciasPorAlumno = [];
        foreach ($registros as $registro) {
            foreach ($registro->asistencias as $asistencia) {
                $alumno = $asistencia->grupoAlumno->alumno;
                $alumnoId = $alumno->id;
                $alumnoNombre = $alumno->apellido_paterno . ' ' .
                    $alumno->apellido_materno . ' ' .
                    $alumno->nombres;

                // Inicializa la entrada para el alumno si no existe
                if (!isset($asistenciasPorAlumno[$alumnoId])) {
                    $asistenciasPorAlumno[$alumnoId] = [
                        'nombre' => $alumnoNombre,
                        'apellido_paterno' => $alumno->apellido_paterno,
                        'asistencias' => []
                    ];
                }

                // Crea la llave combinando fecha y hora
                $fechaHora = $registro->fecha . ' ' . $registro->hora;

                // Añade la asistencia a la lista para la fecha y hora correspondientes
                $asistenciasPorAlumno[$alumnoId]['asistencias'][$fechaHora] = $asistencia['asistio'];
            }
        }

        // Paso 3: Ordenar el array por apellido_paterno
        uasort($asistenciasPorAlumno, function ($a, $b) {
            return strcmp($a['apellido_paterno'], $b['apellido_paterno']);
        });

        // Nota: uasort mantiene las claves originales del array, si quieres un array indexado, usa array_values
        $asistenciasPorAlumno = array_values($asistenciasPorAlumno);

        // Obtener fechas y horas únicas
        $fechasHoras = $registros->map(function ($registro) {
            return $registro->fecha . ' ' . $registro->hora;
        })->unique()->sort();

        $docente = auth()->user();

        // return view('pdf.docente.asistencias', [
        //     'grupo' => $grupo,
        //     'docente' => $docente,
        //     'asistenciasPorAlumno' => $asistenciasPorAlumno,
        //     'fechas' => $fechasHoras,
        //     'incluirHoras' => $incluirHoras
        // ]);

        // Cargar la vista y pasarle los datos
        $pdf = Pdf::loadView('pdf.docente.asistencias', [
            'grupo' => $grupo,
            'docente' => $docente,
            'asistenciasPorAlumno' => $asistenciasPorAlumno,
            'fechas' => $fechasHoras,
            'incluirHoras' => $incluirHoras
        ]);

        // Retornar el PDF para su descarga o visualización
        return $pdf->download(
            'Reporte de asistencias - '
                . $grupo->nombre . ' del '
                . $fechaInicio . ' al '
                . $fechaFin . '.pdf'
        );
    }
}
