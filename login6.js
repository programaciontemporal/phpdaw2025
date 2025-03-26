$(function () {
    // Validación del formulario
    $('#loginForm').submit(function (e) {
        e.preventDefault();

        // Validar campos
        let isValid = true;
        $('input[required]').each(function () {
            if (!$(this).val()) {
                $(this).css('box-shadow', 'inset 0 -5px 45px rgba(255, 0, 0, 0.2), 0 1px 1px rgba(255, 255, 255, 0.2)');
                isValid = false;
            } else {
                $(this).css('box-shadow', 'inset 0 -5px 45px rgba(100, 100, 100, 0.2), 0 1px 1px rgba(255, 255, 255, 0.2)');
            }
        });

        if (isValid) {
            // Simular envío
            const btn = $('.btn-primary');
            btn.html('<i class="fas fa-spinner fa-spin"></i> Procesando...');
            btn.prop('disabled', true);

            setTimeout(function () {
                alert('Inicio de sesión exitoso (simulación)');
                btn.html('Ingresar');
                btn.prop('disabled', false);
                // window.location.href = 'dashboard.html';
            }, 1500);
        }
    });
});