<?php
    session_start();
    if (isset($_SESSION["usuario"])) {
        echo "¡Bienvenido, " . $_SESSION["usuario"] . "!";
        echo "<br><a href='cerrar_sesion.php'>Cerrar sesión</a>";
    } else {
        echo "No has iniciado sesión. <a href='login.php'>Volver al inicio</a>";
    }
?>
