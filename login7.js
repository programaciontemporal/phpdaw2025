$(function () {
    // Validación del formulario
    $('#loginForm').submit(function (e) {
        e.preventDefault();

        // Validar campos
        let isValid = true;
        $('input[required]').each(function () {
            if (!$(this).val()) {
                $(this).css('box-shadow', '0 0 5px rgba(255,0,0,0.5)');
                isValid = false;
            } else {
                $(this).css('box-shadow', '0 1px 0 rgba(255,255,255,0.1)');
            }
        });

        if (isValid) {
            // Simular envío
            const btn = $('input[type="submit"]');
            btn.val('Ingresando...');
            btn.prop('disabled', true);

            setTimeout(function () {
                alert('Acceso exitoso (simulación)');
                btn.val('Ingresar');
                btn.prop('disabled', false);
                // Envío real del formulario:
                // this.submit();
            }, 1500);
        }
    });
});