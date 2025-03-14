<?php
    session_start(); // Iniciar la sesión
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $_SESSION["usuario"] = $_POST["usuario"]; // Guardar el nombre en la sesión
        header("Location: bienvenida.php"); // Redirigir a la página de bienvenida
        exit();
    }
?>
