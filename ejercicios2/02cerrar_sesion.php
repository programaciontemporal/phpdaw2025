<?php
session_start();
session_destroy(); // Cierra la sesión
header("Location: 02login.php"); // Redirige al usuario al login
exit();
?>