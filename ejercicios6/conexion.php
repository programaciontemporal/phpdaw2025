<?php

/*
    Conexión con la base de datos usando PDO
    Conéctate a una base de datos MySQL llamada biblioteca y
    muestra un mensaje si la conexión es exitosa o si falla.
*/

try {
    $pdo = new PDO( 'mysql:host=localhost;dbname=biblioteca', 'root', '' );
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
} catch ( PDOException $e ) {
    echo 'Error de conexión: ' . $e->getMessage();
}
?>
