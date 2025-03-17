<?php
function ordenarArray($array) {
    sort($array);
    return $array;
}

$numeros = [5, 2, 8, 1, 3];
$ordenados = ordenarArray($numeros);
print_r($ordenados);
?>
