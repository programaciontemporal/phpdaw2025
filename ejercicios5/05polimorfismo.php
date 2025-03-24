
<?php
class Figura {
    public function calcularArea() {
        return "Área no definida";
    }
}

class Cuadrado extends Figura {
    public $lado;

    public function __construct($lado) {
        $this->lado = $lado;
    }

    public function calcularArea() {
        return $this->lado * $this->lado;
    }
}

class Circulo extends Figura {
    public $radio;

    public function __construct($radio) {
        $this->radio = $radio;
    }

    public function calcularArea() {
        return pi() * $this->radio * $this->radio;
    }
}

$cuadrado = new Cuadrado(5);
$circulo = new Circulo(3);

echo "Área del cuadrado: " . $cuadrado->calcularArea() . "<br>";
echo "Área del círculo: " . $circulo->calcularArea();
?>

