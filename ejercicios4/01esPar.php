<?php
function esPar($numero) {
    return ($numero % 2 == 0) ? "El número $numero es par" : "El número $numero es impar";
}

echo esPar(17);
?>
