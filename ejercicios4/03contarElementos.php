<?php
function contarElementos($array) {
    return count($array);
}

$colores = ["Rojo", "Verde", "Azul"];
echo "El array tiene " . contarElementos($colores) . " elementos.";
?>
