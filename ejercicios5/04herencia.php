<?php

class Animal {
    public function hacerSonido() {
        return 'Sonido genérico';
    }
}

class Perro extends Animal {
    public function hacerSonido() {
        return 'Guau Guau!';
    }
}

$miPerro = new Perro();
echo $miPerro->hacerSonido();
?>
