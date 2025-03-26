<?php

$separador = '<br><br><hr><br><br>';










// 1.	Crea una clase Libro con propiedades titulo y autor, y un método mostrarInfo().
echo '<h1>clase Libro con propiedades titulo y autor, y un método mostrarInfo()</h1>';

class Libro {
    public $titulo;
    public $autor;

    // métodos

    public function mostrarInfo() {
        return 'Título: <i>' . $this->titulo . '</i>, escrito por <i>' . $this->autor . '</i>.';
    }
}

$libro1 = new Libro();
$libro2 = new Libro();

$libro1->titulo =  'Luces de bohemia';
$libro1->autor = 'Ramón del Valle-Inclán';

$libro2->titulo =  ' Crimen y castigo';
$libro2->autor = 'Fedor Dostoievski';

echo 'Información del libro 1: <br>';
echo $libro1->mostrarInfo() . '<br>';

echo 'Información del libro 2: <br>';
echo $libro2->mostrarInfo() . '<br>';

echo $separador;










// 2.	Define una clase Empleado con un constructor que inicialice nombre y salario.
echo '<h1>clase Empleado con un constructor que inicialice nombre y salario</h1>';

class Empleado {
    private $nombre;
    private $salario;

    public function __construct( $nombre, $salario ) {
        $this->nombre = $nombre;
        $this->salario = $salario;
    }

    public function mostrarInfo() {
        return $this->nombre . ' tiene un salario de ' . $this->salario;
    }
}

$currito1 = new Empleado( 'Antonio García', 2000 );
echo $currito1->mostrarInfo();

echo $separador;










// 3.	Crea una clase CuentaBancaria con métodos para retirar dinero y consultar saldo.
echo '<h1>Clase CuentaBancaria con métodos para retirar dinero y consultar saldo</h1>';

class CuentaBancaria {
    private $titular;
    private $saldo;

    // Constructor

    public function __construct( $titular, $saldo ) {
        $this->titular = $titular;
        $this->saldo = $saldo;
    }

    // Métodos

    public function retirarDinero( $cantidad ) {
        $this->saldo = $this->saldo - $cantidad;
        return "Retirada de $cantidad. Queda un saldo de $this->saldo en la cuenta.";
    }
}

$cuenta1 = new CuentaBancaria( 'Antonio García', 30000 );

echo $cuenta1->retirarDinero( 300 );

echo $separador;










// 4.	Implementa una clase Vehiculo y una subclase Moto que herede de Vehiculo.
echo "<h1>Clase Vehiculo y una subclase Moto que herede de Vehiculo</h1>";

// Clase base Vehiculo
class Vehiculo {
    // Propiedades comunes a todos los vehículos
    protected $marca;
    protected $modelo;
    protected $anio;

    // Constructor
    public function __construct($marca, $modelo, $anio) {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->anio = $anio;
    }

    // Método para obtener la información del vehículo
    public function getInfo() {
        return "Marca: " . $this->marca . ", Modelo: " . $this->modelo . ", Año: " . $this->anio;
    }

    // Método para arrancar el vehículo
    public function arrancar() {
        return "El vehículo está arrancando...";
    }

    // Método para detener el vehículo
    public function detener() {
        return "El vehículo se ha detenido.";
    }
}

// Subclase Moto que hereda de Vehiculo
class Moto extends Vehiculo {
    // Propiedad específica de la moto
    private $cilindrada;

    // Constructor
    public function __construct($marca, $modelo, $anio, $cilindrada) {
        // Llamar al constructor de la clase base (Vehiculo)
        parent::__construct($marca, $modelo, $anio);
        $this->cilindrada = $cilindrada;
    }

    // Método específico de la moto
    public function hacerCaballito() {
        return "La moto está haciendo un caballito...";
    }

    // Sobrescribir el método getInfo para incluir la cilindrada
    public function getInfo() {
        return parent::getInfo() . ", Cilindrada: " . $this->cilindrada . "cc";
    }
}

// Ejemplo de uso
$vehiculo = new Vehiculo("Toyota", "Corolla", 2020);
echo $vehiculo->getInfo() . "<br>"; // Marca: Toyota, Modelo: Corolla, Año: 2020
echo $vehiculo->arrancar() . "<br>"; // El vehículo está arrancando...
echo $vehiculo->detener() . "<br>"; // El vehículo se ha detenido.

$moto = new Moto("Yamaha", "YZF-R1", 2021, 1000);
echo $moto->getInfo() . "<br>"; // Marca: Yamaha, Modelo: YZF-R1, Año: 2021, Cilindrada: 1000cc
echo $moto->arrancar() . "<br>"; // El vehículo está arrancando...
echo $moto->hacerCaballito() . "<br>"; // La moto está haciendo un caballito...
echo $moto->detener() . "<br>"; // El vehículo se ha detenido.

echo $separador;









// 5.	Escribe una interfaz Operaciones con métodos sumar() y restar(), e impleméntala en Calculadora.
echo "<h1>Interfaz <i>Operaciones</i> con métodos sumar y restar</h1>";
// Interface Operaciones con los dos métodos
interface Operaciones {
    public function sumar($a, $b);
    public function restar($a, $b);
}

// Clase Calculadora que implementa la interfaz Operaciones
class Calculadora implements Operaciones {
    // Implementación del método sumar
    public function sumar($a, $b) {
        return $a + $b;
    }

    // Implementación del método restar
    public function restar($a, $b) {
        return $a - $b;
    }

    // Método adicional específico de Calculadora
    public function multiplicar($a, $b) {
        return $a * $b;
    }
}

// Ejemplo de uso
$calculadora = new Calculadora();

// Usando métodos de la interfaz
echo "<p>Suma: " . $calculadora->sumar(5, 3) . "</p>";       // 8
echo "<p>Resta: " . $calculadora->restar(10, 4) . "</p>";    // 6

// Usando método propio de Calculadora
echo "<p>Multiplicación: " . $calculadora->multiplicar(3, 4) . "</p>"; // 12

echo $separador;










// 6.	Crea una clase abstracta InstrumentoMusical con un método tocar() y una subclase Guitarra.
echo "<h1>Clase abstracta InstrumentoMusical</h1>";

// Clase abstracta InstrumentoMusical
abstract class InstrumentoMusical {
    // Propiedad común
    protected $nombre;
    
    // Constructor
    public function __construct($nombre) {
        $this->nombre = $nombre;
    }
    
    // Método abstracto (debe ser implementado por las subclases)
    abstract public function tocar();
    
    // Método concreto (compartido por todas las subclases)
    public function afinar() {
        return "Afinando {$this->nombre}...";
    }
}

// Subclase Guitarra
class Guitarra extends InstrumentoMusical {
    // Propiedad específica
    private $cuerdas;
    
    // Constructor
    public function __construct($cuerdas = 6) {
        parent::__construct("Guitarra"); // Llama al constructor padre
        $this->cuerdas = $cuerdas;
    }
    
    // Implementación del método abstracto
    public function tocar() {
        return "Tocando acordes en la guitarra de {$this->cuerdas} cuerdas";
    }
    
    // Método específico de Guitarra
    public function rasguear() {
        return "¡Rasgueo potente!";
    }
}

// Ejemplo de uso
$miGuitarra = new Guitarra();
echo $miGuitarra->afinar() . "\n";  // Método heredado
echo $miGuitarra->tocar() . "\n";   // Método implementado
echo $miGuitarra->rasguear() . "\n";// Método propio

$guitarra12Cuerdas = new Guitarra(12);
echo $guitarra12Cuerdas->tocar();   // "Tocando acordes en la guitarra de 12 cuerdas"










// 7.	Maneja una excepción en una función que convierta un número en entero.

// 8.	Crea una clase Estudiante que almacene su calificación y valide si está aprobado.

// 9.	Crea una clase Usuario con propiedades nombre, email y contraseña. Implementa métodos para registrar, iniciar sesión ( verificando la contraseña ) y cerrar sesión.

// 10.	Crea una clase Producto y una clase Carrito que permita agregar productos, eliminar productos y calcular el total de la compra.

?>