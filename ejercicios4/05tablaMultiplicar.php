<?php
function tablaMultiplicar($num) {
    for ($i = 1; $i <= 10; $i++) {
        echo "$num x $i = " . ($num * $i) . "<br>";
    }
}

tablaMultiplicar(5);
?>
