<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $color = $_POST["color"];
        setcookie("color", $color, time() + (86400 * 30), "/"); // Guarda la cookie por 30 días
        header("Location: color.php"); // Redirige de nuevo a la página principal
        exit();
    }
?>
