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
            const radioButton = studentRow.querySelector("input[value='p']");
            radioButton.checked = true;

            // Mostrar el modal
            $('#autoCloseModal').modal('show');

            // Cerrar el modal después de 3 segundos (3000 milisegundos)
            setTimeout(function () {
                $('#autoCloseModal').modal('hide');
            }, 1500);
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