<?php

class Coche {
    public $marca;
    public $modelo;

    public function __construct( $marca, $modelo ) {
        $this->marca = $marca;
        $this->modelo = $modelo;
    }

    public function mostrarCoche() {
        return 'Coche: ' . $this->marca . ' ' . $this->modelo;
    }
}

$coche1 = new Coche( 'Toyota', 'Corolla' );
echo $coche1->mostrarCoche();
?>
