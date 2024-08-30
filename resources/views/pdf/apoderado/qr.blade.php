<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documento PDF</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
            padding: 20px;
            box-sizing: border-box;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #555555;
        }

        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="content">
            {!! QrCode::size(250)->generate($alumno->id) !!}
        </div>
        <div class="footer">
            {{ $alumno->apellido_paterno . ' ' . $alumno->apellido_materno . ' ' . $alumno->nombres }}
        </div>
    </div>
</body>

</html>
