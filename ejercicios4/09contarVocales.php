<?php

function contarVocales( $texto ) {
    $vocales = [ 'a', 'e', 'i', 'o', 'u' ];
    $contador = 0;
    $texto = strtolower( $texto );

    for ( $i = 0; $i < strlen( $texto );
    $i++ ) {
        if ( in_array( $texto[ $i ], $vocales ) ) {
            $contador++;
        }
    }
    return "La cadena tiene $contador vocales.";
}

echo contarVocales( 'guineoecuatorial' );
?>
