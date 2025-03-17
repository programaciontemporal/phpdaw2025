<?php
function sumaImpares() {
    $suma = 0;
    for ($i = 1; $i <= 50; $i += 2) {
        $suma += $i;
    }
    return $suma;
}

echo "La suma de impares del 1 al 50 es: " . sumaImpares();
?>
