<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Inicio de Sesión</title>
</head>
<body>
    <h1>Resultado de Inicio de Sesión</h1>
    <?php
    // Simulación de una base de datos de usuarios
    $usuarios_registrados = [
        "juan" => "juan123",
        "ana" => "ana123",
        "pedro" => "pedro123"
    ];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $usuario = htmlspecialchars($_POST['usuario']);
        $contrasena = $_POST['contrasena'];

        // Verificar si el usuario existe y la contraseña coincide
        if (array_key_exists($usuario, $usuarios_registrados) && $usuarios_registrados[$usuario] == $contrasena) {
            echo "<p>¡Bienvenido, $usuario!</p>";
        } else {
            echo "<p>Error: Nombre de usuario o contraseña incorrectos.</p>";
            echo '<a href="login.php">Volver al formulario</a>';
        }
    } else {
        echo "<p>No se han recibido datos.</p>";
    }
    ?>
</body>
</html>