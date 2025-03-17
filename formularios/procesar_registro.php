<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = htmlspecialchars($_POST["nombre"]);
        $email = htmlspecialchars($_POST["email"]);

        echo "<h2>Datos Recibidos</h2>";
        echo "Nombre: " . $nombre . "<br>";
        echo "Correo Electrónico: " . $email . "<br>";
    } else {
        echo "Error en el formulario.";
    }
?>
