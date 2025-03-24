<?php
abstract class Ave {
    abstract public function volar();
}

class Aguila extends Ave {
    public function volar() {
        return 'El águila vuela alto';
    }
}

$aguila = new Aguila();
echo $aguila->volar();
?>
