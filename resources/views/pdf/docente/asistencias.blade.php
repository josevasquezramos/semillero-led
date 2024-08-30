<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            margin: 20px;
            color: #333;
        }

        h2 {
            color: #dc3545;
            font-size: 20px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 6px;
            text-align: center;
        }

        th {
            background-color: #6c757d;
            color: white;
            font-weight: bold;
        }

        .bg-verde {
            background-color: #d4edda;
        }

        .bg-rojo {
            background-color: #f8d7da;
        }

        .bg-amarillo {
            background-color: #fff3cd;
        }

        .bg-azul {
            background-color: #d1ecf1;
        }

        tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }
    </style>
</head>

<body>
    <h2>Reporte de Asistencias del Grupo: {{ $grupo->nombre }}</h2>
    <p><b>Curso: </b>{{ $grupo->curso->nombre }}</p>
    <p><b>Periodo: </b>{{ $grupo->periodo->nombre }}</p>
    <p><b>Docente: </b>{{ $docente->name }}</p>
    <table>
        <thead>
            <tr>
                <th>N°</th>
                <th>Alumno</th>
                @php
                    $formatoFecha = $incluirHoras ? 'd/m h:i' : 'd/m';
                @endphp
                @foreach ($fechas as $fecha)
                    <th>{{ \Carbon\Carbon::parse($fecha)->format($formatoFecha) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @php
                $i = 1;
            @endphp
            @foreach ($asistenciasPorAlumno as $asistencia)
                <tr>
                    <td>{{ $i }}</td>
                    <td style="text-align: left;">{{ $asistencia['nombre'] }}</td>
                    @foreach ($fechas as $fecha)
                        @php
                            $estado = $asistencia['asistencias'][$fecha] ?? '';
                            $class = '';
                            if ($estado == 'p') {
                                $class = 'bg-verde';
                            } elseif ($estado == 'f') {
                                $class = 'bg-rojo';
                            } elseif ($estado == 't') {
                                $class = 'bg-amarillo';
                            } elseif ($estado == 'j') {
                                $class = 'bg-azul';
                            }
                        @endphp
                        <td class="{{ $class }}">{{ Str::upper($estado) }}</td>
                    @endforeach
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>
</body>

</html>
