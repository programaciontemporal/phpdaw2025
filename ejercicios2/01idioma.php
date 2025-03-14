<?php
// Iniciar la sesión ( opcional, pero útil para manejar sesiones )
session_start();

// Definir los mensajes de bienvenida en diferentes idiomas
$mensajes = [
    'es' => '¡Bienvenido!',
    'en' => 'Welcome!',
    'fr' => 'Bienvenue!',
];

// Verificar si se ha enviado el formulario con la selección de idioma
if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' && isset( $_POST[ 'idioma' ] ) ) {
    $idioma = $_POST[ 'idioma' ];

    // Guardar la selección en una cookie ( dura 30 días )
    setcookie( 'idioma', $idioma, time() + ( 86400 * 30 ), '/' );
    // 86400 = 1 día

    // Redirigir para evitar el reenvío del formulario al recargar
    header( 'Location: ' . $_SERVER[ 'PHP_SELF' ] );
    exit();
}

// Obtener el idioma seleccionado de la cookie ( si existe )
$idioma_seleccionado = $_COOKIE[ 'idioma' ] ?? 'es';
// Por defecto, español

// Obtener el mensaje de bienvenida según el idioma seleccionado
$mensaje_bienvenida = $mensajes[ $idioma_seleccionado ] ?? $mensajes[ 'es' ];
?>

<!DOCTYPE html>
<html lang = 'es'>
<head>
<meta charset = 'UTF-8'>
<meta name = 'viewport' content = 'width=device-width, initial-scale=1.0'>
<title>Sistema de Preferencias de Idioma</title>
</head>
<body>
<h1>Sistema de Preferencias de Idioma</h1>

<!-- Mostrar el mensaje de bienvenida -->
<p><?php echo $mensaje_bienvenida;
?></p>

<!-- Formulario para seleccionar el idioma -->
<form method = 'POST' action = ''>
<label for = 'idioma'>Selecciona tu idioma preferido:</label>
<select name = 'idioma' id = 'idioma'>
<option value = 'es' <?php echo ( $idioma_seleccionado === 'es' ) ? 'selected' : '';
?>>Español</option>
<option value = 'en' <?php echo ( $idioma_seleccionado === 'en' ) ? 'selected' : '';
?>>Inglés</option>
<option value = 'fr' <?php echo ( $idioma_seleccionado === 'fr' ) ? 'selected' : '';
?>>Francés</option>
</select>
<button type = 'submit'>Guardar preferencia</button>
</form>
</body>
</html>