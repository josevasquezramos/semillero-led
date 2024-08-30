<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escanear QR</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Asegura que solo el modal de la cámara ocupe toda la pantalla */
        #scanModal .modal-dialog {
            margin: 0;
            width: 100%;
            height: 100%;
            max-width: none;
            max-height: none;
        }

        #scanModal .modal-content {
            height: 100%;
            border-radius: 0;
        }

        /* Ajusta el contenedor del video para que ocupe toda la pantalla */
        #videoWrapper {
            position: relative;
            width: 100%;
            height: 100%;
            background: black;
        }

        /* El video se ajusta a su contenedor */
        #video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Ajusta el marco de "L" */
        #qrFrame {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 80vw;
            /* Tamaño máximo basado en el ancho de la pantalla */
            height: 80vw;
            /* Tamaño máximo basado en el ancho de la pantalla */
            max-width: 80vh;
            /* Tamaño máximo basado en la altura de la pantalla */
            max-height: 80vh;
            /* Tamaño máximo basado en la altura de la pantalla */
            transform: translate(-50%, -50%);
            box-sizing: border-box;
            border: 4px solid transparent;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: stretch;
        }

        /* Marco de L en las cuatro esquinas */
        #qrFrame::before,
        #qrFrame::after {
            content: '';
            position: absolute;
            width: 20%;
            /* Tamaño del marco */
            height: 20%;
            /* Tamaño del marco */
            border: 4px solid white;
        }

        #qrFrame::before {
            top: 0;
            left: 0;
            border-right: none;
            border-bottom: none;
        }

        #qrFrame::after {
            bottom: 0;
            right: 0;
            border-left: none;
            border-top: none;
        }

        /* Marco de L en las esquinas restantes */
        #qrFrame div {
            position: absolute;
            width: 20%;
            /* Tamaño del marco */
            height: 20%;
            /* Tamaño del marco */
            border: 4px solid white;
        }

        #qrFrame div:nth-child(1) {
            top: 0;
            left: 0;
            border-right: none;
            border-bottom: none;
        }

        #qrFrame div:nth-child(2) {
            top: 0;
            right: 0;
            border-left: none;
            border-bottom: none;
        }

        #qrFrame div:nth-child(3) {
            bottom: 0;
            left: 0;
            border-right: none;
            border-top: none;
        }

        #qrFrame div:nth-child(4) {
            bottom: 0;
            right: 0;
            border-left: none;
            border-top: none;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Lista de Alumnos</h2>
        <button class="btn btn-primary mb-3" id="scanButton" data-toggle="modal" data-target="#scanModal">Escanear
            QR</button>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Alumno</th>
                    <th>P</th>
                    <th>T</th>
                    <th>J</th>
                </tr>
            </thead>
            <tbody id="studentTable">
                <tr data-id="1">
                    <td>Juan Perez</td>
                    <td><input type="radio" name="[1][1]" value="P" required></td>
                    <td><input type="radio" name="[1][1]" value="T" required></td>
                    <td><input type="radio" name="[1][1]" value="J" required></td>
                </tr>
                <tr data-id="2">
                    <td>Maria Gomez</td>
                    <td><input type="radio" name="[1][2]" value="P"></td>
                    <td><input type="radio" name="[1][2]" value="T"></td>
                    <td><input type="radio" name="[1][2]" value="J"></td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Modal para escanear QR -->
    <div class="modal fade" id="scanModal" tabindex="-1" role="dialog" aria-labelledby="scanModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="scanModalLabel">Escanear QR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body p-0">
                    <div id="videoWrapper">
                        <video id="video" autoplay></video>
                        <div id="qrFrame">
                            <!-- Cuatro marcos en las esquinas -->
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de error -->
    <div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="errorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Error</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger mb-0" role="alert">
                        No hemos podido encontrar al alumno en la lista o ha habido un problema con la cámara o código
                        QR.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast de éxito -->
    <div class="position-fixed bottom-0 right-0 p-3" style="z-index: 5; right: 0; bottom: 0;">
        <div id="successToast" class="toast bg-success text-white" role="alert" aria-live="assertive"
            aria-atomic="true" data-delay="3000">
            <div class="toast-header">
                <strong class="mr-auto text-dark">Presente!</strong>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body p-0">
                <div class="alert alert-success m-0 p-3" role="alert">
                    Asistencia marcada correctamente.
                </div>
            </div>
        </div>
    </div>

    <!-- Incluye las librerías necesarias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/@zxing/library@latest"></script>

    <script>
        let codeReader;
        let isModalClosedManually = false;

        $('#scanModal').on('shown.bs.modal', () => {
            isModalClosedManually = false; // Reset the flag

            // Inicializar el lector de QR cuando se abre el modal
            codeReader = new ZXing.BrowserQRCodeReader();
            codeReader.decodeOnceFromVideoDevice(undefined, 'video').then((result) => {
                const studentId = result.text;
                const studentRow = document.querySelector(`tr[data-id='${studentId}']`);

                if (studentRow) {
                    const radioButton = studentRow.querySelector("input[value='P']");
                    radioButton.checked = true;

                    // Mostrar la toast de éxito
                    $('#successToast').toast('show');
                } else {
                    $('#errorModal').modal('show');
                }

                // Reiniciar el lector para permitir otro escaneo
                codeReader.reset();
                $('#scanModal').modal('hide');

            }).catch((err) => {
                console.error("Error durante el escaneo:", err);
                if (!isModalClosedManually) {
                    $('#errorModal').modal('show');
                }
            });
        });

        $('#scanModal').on('hidden.bs.modal', () => {
            isModalClosedManually = true; // Mark that the modal was closed manually
            if (codeReader) {
                codeReader.reset(); // Detener el lector cuando se cierra el modal
                codeReader = null;
            }
        });
    </script>
</body>

</html>
