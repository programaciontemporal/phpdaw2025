<?php
function generarArrayAleatorio() {
    $array = [];
    for ($i = 0; $i < 10; $i++) {
        $array[] = rand(1, 100);
    }
    return $array;
}

print_r(generarArrayAleatorio());
?>
