<?php
    session_start();
    session_destroy(); // Cierra la sesión
    header("Location: login.php"); // Redirige al usuario al login
    exit();
?>
