<?php
try {
    throw new Exception( 'División entre cero' );
} catch ( Exception $e ) {
    echo 'Error: ' . $e->getMessage();
}
?>
