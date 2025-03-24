
<?php
class CuentaBancaria {
    private $saldo = 5000;

    public function obtenerSaldo() {
        return "Saldo disponible: $" . $this->saldo;
    }

    public function depositar($cantidad) {
        if ($cantidad > 0) {
            $this->saldo += $cantidad;
        }
    }
}

$cuenta = new CuentaBancaria();
$cuenta->depositar(1000);
echo $cuenta->obtenerSaldo();
?>
