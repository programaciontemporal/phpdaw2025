<?php
interface Vehiculo {
    public function arrancar();
}

class Moto implements Vehiculo {
    public function arrancar() {
        return 'La moto está en marcha';
    }
}

$moto = new Moto();
echo $moto->arrancar();
?>
