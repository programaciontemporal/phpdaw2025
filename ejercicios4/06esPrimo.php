<?php
function esPrimo($num) {
    if ($num < 2) return false;
    for ($i = 2; $i < $num; $i++) {
        if ($num % $i == 0) return false;
    }
    return true;
}

echo esPrimo(8) ? "Es primo" : "No es primo";
?>
