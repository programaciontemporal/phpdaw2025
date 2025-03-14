<?php
session_start(); // Iniciar la sesión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];

    // Verificar si el usuario es "admin" o un usuario común
    if ($usuario === "admin") {
        $_SESSION["usuario"] = $usuario;
        $_SESSION["tipo_usuario"] = "admin"; // Guardar el tipo de usuario
    } else {
        $_SESSION["usuario"] = $usuario;
        $_SESSION["tipo_usuario"] = "comun"; // Guardar el tipo de usuario
    }

    header("Location: 02bienvenida.php"); // Redirigir a la página de bienvenida
    exit();
}
?>