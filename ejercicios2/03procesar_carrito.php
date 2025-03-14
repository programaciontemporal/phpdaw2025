<?php
session_start(); // Iniciar la sesión

if (!isset($_SESSION["carrito"])) {
    $_SESSION["carrito"] = []; // Inicializar el carrito si no existe
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["accion"])) {
        $accion = $_POST["accion"];

        if ($accion === "Agregar al carrito" && isset($_POST["productos"])) {
            // Agregar productos al carrito
            foreach ($_POST["productos"] as $producto) {
                if (!in_array($producto, $_SESSION["carrito"])) {
                    $_SESSION["carrito"][] = $producto;
                }
            }
        } elseif ($accion === "Vaciar carrito") {
            // Vaciar el carrito
            $_SESSION["carrito"] = [];
        }
    }
}

header("Location: 03carrito.php"); // Redirigir al carrito
exit();
?>