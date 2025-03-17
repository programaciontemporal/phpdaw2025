<?php
function factorial($num) {
    $resultado = 1;
    for ($i = 1; $i <= $num; $i++) {
        $resultado *= $i;
    }
    return $resultado;
}

echo "El factorial de 5 es: " . factorial(5);
?>
