<?php
    echo "Datos introducidos: <br><br>";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];
        echo "Nombre: $nombre<br>";
        echo "email: $email<br>";
        echo "Teléfono: $telefono";
    }

?>