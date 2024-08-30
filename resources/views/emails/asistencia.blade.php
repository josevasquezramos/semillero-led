<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estado de Asistencia</title>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card {
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
        }

        .card-header {
            background-color: #343a40;
            color: #ffffff;
            padding: 15px;
            text-align: center;
            font-size: 1.25em;
        }

        .card-body {
            padding: 15px;
        }

        .card-footer {
            background-color: #f1f1f1;
            color: #6c757d;
            padding: 10px;
            text-align: center;
            font-size: 0.875em;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 12px;
            font-size: 0.875em;
            font-weight: bold;
            display: inline-block;
        }

        .badge-primary {
            background-color: #007bff;
            color: #ffffff;
        }

        .badge-secondary {
            background-color: #6c757d;
            color: #ffffff;
        }

        .badge-success {
            background-color: #28a745;
            color: #ffffff;
        }

        .badge-danger {
            background-color: #dc3545;
            color: #ffffff;
        }

        .badge-warning {
            background-color: #ffc107;
            color: #212529;
        }

        .badge-info {
            background-color: #17a2b8;
            color: #ffffff;
        }

        .badge-light {
            background-color: #f8f9fa;
            color: #212529;
        }

        .badge-dark {
            background-color: #343a40;
            color: #ffffff;
        }
    </style>
</head>

<body style="background-color: #f8f9fa;">
    <div class="container my-4">
        <div class="card">
            <div class="card-header text-center bg-dark text-white">
                <h5>Estado de Asistencia a Clases</h5>
            </div>
            <div class="card-body">
                <p class="card-text">Estimado(a) {{ $apoderado->apoderado_nombre }},</p>
                <p>
                    Le informamos que {{ $alumno->nombres }} {{ $alumno->apellido_paterno }}
                    {{ $alumno->apellido_materno }} <span
                        class="badge badge-{{ $diseno }}">{{ $estado }}</span> al curso de
                        {{ $curso->curso_nombre }} el día {{ $fecha }}.
                </p>
                <p class="card-text">Por favor, si tiene alguna duda o necesita más información, no dude en
                    contactarnos.</p>
            </div>
            <div class="card-footer text-center text-muted">
                &copy; {{ date('Y') }} LED. Todos los derechos reservados.
            </div>
        </div>
    </div>
</body>

</html>
