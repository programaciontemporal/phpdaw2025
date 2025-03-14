<?php
// Iniciar la sesión (opcional, no es necesario para este ejemplo)
session_start();

// Definir el nombre de la cookie
$cookie_name = "contador_visitas";

// Verificar si la cookie ya existe
if (isset($_COOKIE[$cookie_name])) {
    // Si la cookie existe, incrementar el contador
    $visitas = $_COOKIE[$cookie_name] + 1;
} else {
    // Si la cookie no existe, inicializar el contador en 1
    $visitas = 1;
}

// Guardar el contador en una cookie (dura 30 días)
setcookie($cookie_name, $visitas, time() + (86400 * 30), "/");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Contador de Visitas</title>
</head>
<body>
    <h1>Bienvenido a la página</h1>

    <?php if ($visitas == 1): ?>
        <p>Esta es tu primera visita. ¡Gracias por venir!</p>
    <?php else: ?>
        <p>Has visitado esta página <?php echo $visitas; ?> veces.</p>
    <?php endif; ?>

    <br>
    <p><a href="04contador.php">Recargar página</a></p>
</body>
</html>