<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado del Formulario</title>
</head>
<body>
    <h1>Resultado del Formulario</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $nombre = htmlspecialchars($_POST['nombre']);
        $edad = intval($_POST['edad']);
        $telefono = $_POST['telefono'];

        // Validar los datos
        $errores = [];

        // Validar que la edad sea mayor a 18
        if ($edad <= 18) {
            $errores[] = "La edad debe ser mayor a 18 años.";
        }

        // Validar que el teléfono tenga 9 dígitos
        if (!preg_match("/^\d{9}$/", $telefono)) {
            $errores[] = "El teléfono debe tener exactamente 9 dígitos.";
        }

        // Mostrar errores o los datos enviados
        if (empty($errores)) {
            echo "<p><strong>Nombre:</strong> $nombre</p>";
            echo "<p><strong>Edad:</strong> $edad</p>";
            echo "<p><strong>Teléfono:</strong> $telefono</p>";
        } else {
            echo "<p>Errores encontrados:</p>";
            echo "<ul>";
            foreach ($errores as $error) {
                echo "<li>$error</li>";
            }
            echo "</ul>";
        }
    } else {
        echo "<p>No se han recibido datos.</p>";
    }
    ?>
    <p><a href="datos.php">Volver al formulario</a></p>
</body>
</html>