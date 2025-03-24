<?php

class Persona {
    public $nombre;
    public $edad;

    public function mostrarInformacion() {
        return 'Nombre: ' . $this->nombre . ', Edad: ' . $this->edad . ' años.';
    }
}

$persona1 = new Persona();
$persona1->nombre = 'Carlos';
$persona1->edad = 30;
echo $persona1->mostrarInformacion();
?>
