<?php
function buscarValor($array, $valor) {
    return in_array($valor, $array) ? "El valor $valor está en el array" : "El valor $valor no está en el array";
}

$nombres = ["Carlos", "Ana", "Luis"];
echo buscarValor($nombres, "Ana");
?>
