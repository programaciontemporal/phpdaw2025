<?php

$separador = "<br><br><br><hr><br><br><br>";

// 1. Mostrar "Hola, Mundo!" en pantalla
echo "Hola, Mundo!";

echo $separador;


// 2. Declarar variables y mostrarlas
$nombre = "Juan";
$edad = 25;
echo "Hola, mi nombre es $nombre y tengo $edad años.";

echo $separador;


// 3. Suma de dos números
$num1 = 10;
$num2 = 20;
$resultado = $num1 + $num2;
echo "La suma de $num1 y $num2 es: $resultado";

echo $separador;


// 4. Verificar si un número es par o impar
$numero = 7;
if ($numero % 2 == 0) {
    echo "El número $numero es par.";
} else {
    echo "El número $numero es impar.";
}

echo $separador;


// 5. Usar un bucle for para contar del 1 al 10

for ($i = 1; $i <= 10; $i++) {
    echo "Número: $i <br>";
}

// Explicación: El bucle for ejecuta el código 10 veces, incrementando $i en cada iteración.

echo $separador;


// 6. Listar elementos de un array con foreach

$colores = ["Rojo", "Verde", "Azul", "Amarillo"];
foreach ($colores as $color) {
    echo "Color: $color <br>";
}

// Explicación: Se usa foreach para recorrer un array e imprimir sus valores.

echo $separador;


// 7. Función para calcular el área de un rectángulo

function calcularArea($ancho, $alto)
{
    return $ancho * $alto;
}
echo "El área del rectángulo es: " . calcularArea(5, 10);

echo $separador;


// 8. Capturar datos de un formulario con POST
// formulario.html
//
//<form method="post" action="procesar.php">
//    Nombre: <input type="text" name="nombre">
//    <input type="submit" value="Enviar">
//</form>
// procesar.php

//    if ($_SERVER["REQUEST_METHOD"] == "POST") {
//       $nombre = $_POST['nombre'];
//        echo "Hola, $nombre";
//    }

// Explicación: $_POST recibe los datos enviados por el formulario y los imprime en la pantalla.


// 9. Conectar a una base de datos MySQL

$conn = new mysqli("localhost", "root", "", "pruebasphp_db");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa";

// Explicación: Se usa mysqli para conectar a una base de datos MySQL.

echo $separador;


// 10. Guardar y recuperar datos en una sesión
// guardar_sesion.php

session_start();
$_SESSION['usuario'] = "Carlos";
echo "Sesión iniciada para: " . $_SESSION['usuario'];

echo $separador;
// recuperar_sesion.php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
echo "Usuario en sesión: " . $_SESSION['usuario'];
session_destroy();
// Explicación: Se usa session_start() para almacenar y recuperar datos de sesión.

echo $separador;

// cerrar la sesión


// 11. Crear y leer una cookie
// crear_cookie.php

setcookie("usuario", "Ana", time() + 3600, "/");
echo "Cookie creada.";

echo $separador;
// leer_cookie.php

if (isset($_COOKIE['usuario'])) {
    echo "Usuario: " . $_COOKIE['usuario'];
} else {
    echo "No hay cookies disponibles.";
}

// Explicación: Se crea una cookie con setcookie() y se lee con $_COOKIE.


echo $separador;

// 12. Uso de switch para seleccionar opciones

$dia = "martes";
switch ($dia) {
    case "lunes":
        echo "Inicio de semana.";
        break;
    case "viernes":
        echo "Fin de semana próximo.";
        break;
    default:
        echo "Día normal.";
}



//                              Ejercicios propuestos                                \\

// 1.	Definir una variable con tu nombre y mostrar un mensaje de bienvenida.
$miNombre = "Antonio";
echo "Saludos $miNombre";

echo $separador;

// 2.	Crear una función que reciba dos números y retorne su suma.
function sumar($num1, $num2)
{
    return $num1 + $num2;
}

sumar(10, 30);       // Resultado esperado: 40

echo $separador;

// 3.	Crear un array con 5 colores y mostrarlos con un bucle foreach.
$colores2 = ["Rojo", "Verde", "Azul", "Amarillo", "Negro"];
foreach ($colores2 as $color) {
    echo "Color: $color <br>";
}

echo $separador;

// 4.	Definir una variable edad y usar if para verificar si es mayor de edad.
$edadDos = 20;
if ($edadDos >= 18) {
    echo "Es mayor de edad.";
} else {
    echo "Es menor de edad.";
}

echo $separador;

// 5.	Crear un formulario que pida nombre, email y teléfono y los muestre en otra página.
// formulario2.html
// procesar2.php

// 6.	Conectar a una base de datos y mostrar los registros de una tabla.
$conn = new mysqli("localhost", "root", "", "biblioteca");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
echo "Conexión exitosa<br><hr>";

// Consulta SQL para obtener todos los libros
$sql = "SELECT * FROM libros";

// Ejecutar la consulta
$result = $conn->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    // Si hay resultados, los mostramos
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row["id_libro"] . " - Título: " . $row["titulo"] . " - Autor: " . $row["autor"] . "<br>";
    }
} else {
    echo "No se encontraron libros.";
}

$conn->close();

echo $separador;


// 7.	Usar un while para contar del 1 al 5 e imprimir cada número.
$i = 1;
while ($i <= 5) {
    echo $i."<br>";
    $i++;
}

echo $separador;


// 8.	Define una función que tome dos números como parámetros y devuelva su suma.
// esto es el numero 2. YO hago el producto...
function multiplicar($num1, $num2)
{
    return $num1 * $num2;
}

echo multiplicar(20, 5);

echo $separador;

// 9.	Crea un array con 5 colores y recórrelo con foreach.
// este es el mismo que el 5
$colores3 = ["Rojo", "Verde", "Azul", "Amarillo", "Negro"];
foreach ($colores3 as $color) {
    echo "Color: $color <br>";
}

echo $separador;


// 10.	Escribe una función que determine si un número es par o impar.
function parImpar($num)
{
    if (fmod($num, 2) == 0) {
        echo "El número es par";
    } else {
        echo "El número es impar";
    }
}

echo parImpar(4);       // resultado esperado: par
echo "<br>";
echo parImpar(7);       // impar

echo $separador;


// 11.	Conéctate a una base de datos y muestra los datos de una tabla en pantalla.


// 12.	Usa un bucle while para imprimir los números del 1 al 5.
