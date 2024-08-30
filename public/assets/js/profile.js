
document.addEventListener('DOMContentLoaded', function () {
    // Guardar los valores iniciales de los campos del formulario de perfil
    const initialProfileData = {};

    function saveInitialProfileData() {
        const profileForm = document.querySelector('#nav-profile form');
        if (profileForm) {
            const formData = new FormData(profileForm);
            formData.forEach((value, key) => {
                initialProfileData[key] = value;
            });
        }
    }

    // Restaurar los valores iniciales al regresar a la pestaña de perfil
    function restoreInitialProfileData() {
        const profileForm = document.querySelector('#nav-profile form');
        if (profileForm) {
            for (const key in initialProfileData) {
                const input = profileForm.querySelector(`[name="${key}"]`);
                if (input) {
                    input.value = initialProfileData[key];
                }
            }
        }
    }

    // Guardar los valores iniciales al cargar la página
    saveInitialProfileData();

    // Agregar evento para detectar cambio de pestaña
    document.querySelectorAll('.nav-link').forEach(link => {
        link.addEventListener('click', function () {
            if (this.getAttribute('data-target') === '#nav-profile') {
                restoreInitialProfileData();
            }
        });
    });

    // Restaurar los valores iniciales cuando la pestaña de perfil se vuelve activa
    document.querySelector('#nav-tabContent').addEventListener('shown.bs.tab', function (event) {
        if (event.target.getAttribute('data-target') === '#nav-profile') {
            restoreInitialProfileData();
        }
    });
});