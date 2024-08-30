<?php

namespace App\Http\Controllers\Apoderado;

use App\Http\Controllers\Controller;
use App\Models\Alumno;
use App\Models\Apoderado;
use Barryvdh\DomPDF\Facade\Pdf;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

// use Illuminate\Http\Request;

class RepresentadoController extends Controller
{
    public function index()
    {
        // Obtener el ID del usuario autenticado
        $userId = auth()->id();

        // Obtener los alumnos asociados al apoderado
        $alumnos = Apoderado::where('user_id', $userId)->with('alumno')->get();

        return view('apoderado.representados.index', compact('alumnos'));
    }

    public function destroy(Alumno $alumno)
    {
        // Eliminar la relación en la tabla apoderados
        Apoderado::where('user_id', auth()->id())->where('alumno_id', $alumno->id)->delete();

        return redirect()->route('apoderado.representados.index')->with('success', 'Alumno desvinculado exitosamente.');
    }

    public function downloadQR(Alumno $alumno)
    {
        
        $qrCodeImage = QrCode::format('png')->size(300)->generate($alumno->id);

        // Establece los encabezados para la descarga
        return response($qrCodeImage)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="QR de ' . $alumno->nombres . '.png"');

        // return view('pdf.apoderado.qr', compact('alumno'));

        // Cargar la vista y pasarle los datos
        // $pdf = Pdf::loadView('pdf.apoderado.qr', [
        //     'alumno' => $alumno,
        // ]);

        // // Retornar el PDF para su descarga o visualización
        // return $pdf->download(
        //     'QR de ' . $alumno->nombres . '.pdf'
        // );
    }
}
