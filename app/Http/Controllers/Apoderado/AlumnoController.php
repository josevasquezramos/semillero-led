<?php

namespace App\Http\Controllers\Apoderado;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Apoderado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AlumnoController extends Controller
{
    /**
     * Método para mostrar el formulario de búsqueda
     */
    public function showSearchForm()
    {
        return view('apoderado.alumnos.search');
    }

    /**
     * Método para buscar un alumno por DNI
     */
    public function searchAlumno(Request $request)
    {
        $request->validate([
            'dni' => 'required|numeric|digits:8',
        ]);

        // Limpiar el valor del DNI
        $dni = trim($request->input('dni'));

        // Buscar el alumno
        $alumno = Alumno::where('dni', $dni)->first();

        if ($alumno) {
            return view('apoderado.alumnos.search', compact('alumno'));
        } else {
            return redirect()->back()->withErrors(
                [
                    'Alumno no encontrado.',
                    'Asegurese de escribir el DNI correctamente.'
                ]
            )->withInput();
        }
    }

    /**
     * Método para agregar un alumno como apoderado
     */
    public function addApoderado($alumnoId)
    {
        $userId = Auth::id();

        $existe = Apoderado::where('user_id', $userId)
            ->where('alumno_id', $alumnoId)
            ->exists();

        $alumno = Alumno::select('apellido_paterno', 'apellido_materno', 'nombres')->find($alumnoId);

        if ($existe) {
            return redirect()->back()->withErrors(
                [
                    'error' => 'Ya eres apoderado del alumno(a) '
                        . $alumno->apellido_paterno . ' '
                        . $alumno->apellido_materno . ' '
                        . $alumno->nombres . '. '
                        . 'Si crees que se trata de un error, no dudes en comunicarte con nosotros.'
                ]
            )->withInput();
        }

        Apoderado::create([
            'user_id' => $userId,
            'alumno_id' => $alumnoId,
        ]);

        return redirect()->back()->with(
            'success',
            'El alumno(a) '
                . $alumno->apellido_paterno . ' '
                . $alumno->apellido_materno . ' '
                . $alumno->nombres . ' ahora está bajo su tutela.'
        );
    }
}
