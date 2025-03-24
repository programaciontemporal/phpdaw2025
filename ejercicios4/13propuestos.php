<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

<?php
// indicar el idioma
setlocale(LC_ALL, 'es_ES');

$separador = "<br><br><hr><br><br>";

// 1.	Crear una función que determine si un número es positivo, negativo o cero.
echo "<h1>Función que determina si un número es positivo, negativo o cero</h1>";
function tipoNumero( $num ) {
    if ( intval($num) == 0 ) {
        return "<p>El número $num es 0</p>";
    } elseif ( intval($num) > 0 ) {
        return "<p>El número $num es positivo</p>";
    } else {
        return "<p>El número $num es negativo</p>";
    }
}

echo tipoNumero( 0 );
echo tipoNumero( 20 );
echo tipoNumero( -35 );

echo $separador;

// 2.	Escribir una función que reciba un array de números y devuelva el promedio.
echo "<h1>Función que recibe un array de números y devulve el promedio</h1>";

function arrayPromedio($array){
    $promedio = 0;
    for ($i = 0; $i < count($array); $i++){
        $promedio = $promedio + $array[$i];
    }
    return $promedio / count($array);
}

$arr01 = [5, 2, 8, 2, 3];                           // 4
$arr02 = [1, 2, 3, 4, 5, 6, 7, 8, 9];               // 5
$arr03 = [5, 10, 15, 20, 25, 30, 35, 40, 45, 50];   // 27,5

echo "Promedio de arr01 = " . arrayPromedio($arr01)."<br>";
echo "Promedio de arr02 = " . arrayPromedio($arr02)."<br>";
echo "Promedio de arr03 = " . arrayPromedio($arr03)."<br>";

echo $separador;

// 3.	Desarrollar una función que cuente cuántas veces aparece un valor en un array.
echo "<h1>Función que cuenta las veces que se repite un valor en un array</h1>";

function contarValores($array, $valor) {
    $numero = array_count_values($array);
    return $numero[$valor] ?? 0;
}

$array = [1, 2, 3, 2, 4, 2, 5];

echo "El número 1 aparece " . contarValores($array, 1) . " veces.<br>";
echo "El número 2 aparece " . contarValores($array, 2) . " veces.<br>";
echo "El número 3 aparece " . contarValores($array, 3) . " veces.<br>";
echo "El número 4 aparece " . contarValores($array, 4) . " veces.<br>";
echo "El número 5 aparece " . contarValores($array, 5) . " veces.<br>";
echo "El número 6 aparece " . contarValores($array, 6) . " veces.<br>";

echo $separador;

// 4.	Escribir un programa que imprima los primeros 10 números de la serie Fibonacci.
echo "<h1>Los 10 primeros números de la serie de Fibonacci</h1>";

function fibonacci() {
    $v1 = 0;
    $v2 = 1;
    //Mostramos el primer número de la serie de Fibonacci
    echo $v1 . '<br>';

    //Realizaremos 10 sucesiones de la secuencia de Fibonacci
    for ($i=0; $i < 10; $i++) { 
        //Variable temporal para almacenar el número de la primera variable
        $temp = $v1;
        //La primera variable pasa a contener el valor de la segunda
        $v1 = $v2;
        //Sumamos el valor de la temporal y la variable 1
        $v2 = $temp + $v1;
        //Imprimimos el resultado
        echo $v1 . '<br>';
    }
}

fibonacci();

echo $separador;

// 5.	Crear una función que reciba una cadena y devuelva la cantidad de palabras que contiene.
echo "<h1>Función que recibe un cadena y devuelve la cantidad de palabras que contiene</h1>";

function contarPalabras($cadena){
    return str_word_count($cadena, 0, "áéíóúñÁÉÍÓÚÑüÜçÇ");
}

$c1 = "Hola como estás";
$c2 = "Esto es una prueba nada más";
$c3 = "Aqui hacemos otra prueba más, con comas y todo, a ver que sale";

echo "<p><i>$c1</i> tiene " . contarPalabras($c1) . " palabras</p>";
echo "<p><i>$c2</i> tiene " . contarPalabras($c2) . " palabras</p>";
echo "<p><i>$c3</i> tiene " . contarPalabras($c3) . " palabras</p>";

echo $separador;

// 6.	Construir una función que invierta el orden de los elementos de un array.
echo "<h1>Función que invierte el orden de los elementos de un array</h1>";

function arrayReverse($array){
    return array_reverse($array);
}

$prueba = ["uno", "dos", "tres", "cuatro", "cinco"];

echo "<p>";
print_r($prueba);
echo "<br>dado la vuelta es:<br>";
print_r(arrayReverse($prueba));
echo("</p>");

echo $separador;

// 7.	Generar una función que devuelva el número más grande de un array.
echo "<h1>Función que devuelve el número más grande dentro de un array</h1>";

function masAlto($array){
    return max($array);
}

echo "<p>El número más alto del array 1 es: ".masAlto($arr01)."</p>";   // 8, línea 47
echo "<p>El número más alto del array 2 es: ".masAlto($arr02)."</p>";   // 9, línea 48
echo "<p>El número más alto del array 3 es: ".masAlto($arr03)."</p>";   // 50, línea 49

echo $separador;

// 8.	Escribir un programa que muestre los números del 1 al 100,
// reemplazando los múltiplos de 3 por 'Fizz', los de 5 por 'Buzz' y los de ambos por 'FizzBuzz'.
echo "<h1>Números del 1 al 100</h1>";
function numerosFizzBuzz(){
    for ($i = 1; $i <= 100; $i++){
        if (($i % 3 == 0) && ($i % 5 == 0)){
            echo "FizzBuzz";
        } elseif ($i % 3 === 0){
            echo "Fizz";
        } elseif ($i % 5 === 0){
            echo "Buzz";
        } else {
            echo $i;
        }
        echo "<br>";
    }
}

echo "<p>Números del 1 al 100: </p>";
numerosFizzBuzz();

echo $separador;

// 9.	Desarrollar una función que reciba una fecha y devuelva el día de la semana.
echo "<h1>Función que recibe una fecha y devuelve el día de la semana</h1>";

function obtenerDiaDeLaSemana($fecha) {
    // Convertir la fecha en formato español (día-mes-año) a un timestamp
    $timestamp = strtotime(str_replace('/', '-', $fecha));
    // Verificar si la conversión fue exitosa
    if ($timestamp === false) {
        return "Fecha no válida";
    }
    // Mapear días de la semana en español
    $dias = [
        'Sunday'    => 'Domingo',
        'Monday'    => 'Lunes',
        'Tuesday'   => 'Martes',
        'Wednesday' => 'Miércoles',
        'Thursday'  => 'Jueves',
        'Friday'    => 'Viernes',
        'Saturday'  => 'Sábado',
    ];
    // Obtener el día de la semana en inglés
    $diaIngles = date('l', $timestamp);
    
    // Devolver el día en español
    return $dias[$diaIngles] ?? "Día no encontrado";
}

$fecha = "15-10-2023";
$fecha2 ="22/09/1976";
echo "<p>El día de la semana para la fecha $fecha es: " . obtenerDiaDeLaSemana($fecha) . "</p>";
echo "<p>El día de la semana para la fecha $fecha2 es: " . obtenerDiaDeLaSemana($fecha2) . "</p>";

echo $separador;
// 10.	Escribir una función que elimine los elementos duplicados de un array.
echo "<h1>Función que elemina los elementos duplicados de un array</h1>";

function eliminarDuplicados($array) {
    // Eliminar duplicados y reindexar el array
    return array_values(array_unique($array));
}

$array = [1, 1, 1, 2, 2, 3, 4, 5, 4, 5];
$resultado = eliminarDuplicados($array);

print_r($resultado);

echo $separador;

// 11.	Crea una función que genere contraseñas aleatorias de una longitud especificada,
// combinando letras, números y caracteres especiales.
echo "<h1>Función que genera una contraseña aleatoria de una longitud determinada</h1>";

function generarContrasena($longitud) {
    // Definir los caracteres posibles
    $caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=[]{}|;:,.<>?';

    // Inicializar la contraseña
    $contrasena = '';

    for ($i = 0; $i < $longitud; $i++) {
        // Seleccionar un carácter aleatorio de la cadena combinada
        $indiceAleatorio = random_int(0, strlen($caracteres) - 1);
        $contrasena .= $caracteres[$indiceAleatorio];
    }

    return $contrasena;
}

echo "<p>Contraseña generada (12 caracteres): " . generarContrasena(12) . "</p>";
echo "<p>Contraseña generada (16 caracteres): " . generarContrasena(16) . "</p>";
echo "<p>Contraseña generada (6 caracteres): " . generarContrasena(6) . "</p>";

echo $separador;

// 12.	Escribe una función que convierta un monto de una moneda a otra, por ejemplo, de USD a EUR,
// utilizando una tasa de cambio predefinida.
echo "<h1>Función de conversión de monedas</h1>";

// Función para convertir monedas
function convertirMoneda($monto, $monedaOrigen, $monedaDestino) {
    // Definir tasas de cambio predefinidas (basadas en USD como referencia)
    $tasasDeCambio = [
        'Dolar' => 1.0,    // Dólar estadounidense
        'Euro'  => 0.85,   // Euro
        'Libra' => 0.73,   // Libra esterlina
        'Yen'   => 110.0,  // Yen japonés
        'Rublo' => 75.0,   // Rublo ruso
    ];
    // Verificar si las monedas existen en el array de tasas
    if (!isset($tasasDeCambio[$monedaOrigen]) || !isset($tasasDeCambio[$monedaDestino])) {
        return "Moneda no válida.";
    }

    // Convertir el monto a USD primero (moneda de referencia)
    $montoEnUSD = $monto / $tasasDeCambio[$monedaOrigen];

    // Convertir de USD a la moneda de destino
    $montoConvertido = $montoEnUSD * $tasasDeCambio[$monedaDestino];

    return $montoConvertido;
}
// Asignar los valores
$monto = 125;
$monedaOrigen = "Euro";
$monedaDestino = "Dolar";
// Realizar la conversión
$resultado = convertirMoneda($monto, $monedaOrigen, $monedaDestino);
echo "<p>" . number_format($monto, 2) . " " . $monedaOrigen . " = " . number_format($resultado, 2) . " " . $monedaDestino . "</p>";

echo $separador;

// 13.	Desarrolla una función que reciba una dirección de correo electrónico y verifique si es válida usando filter_var().
echo "<h1>Función para validar direcciones de email</h1>";

function validarEmail($email) {
    // Usar filter_var para validar el email
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true; // El email es válido
    } else {
        return false; // El email no es válido
    }
}

// Ejemplo de uso
$email = "usuario@example.com";

if (validarEmail($email)) {
    echo "El email '$email' es válido.";
} else {
    echo "El email '$email' no es válido.";
}

echo $separador;

// 14.	Crea una función que reciba una fecha de nacimiento y calcule la edad actual de la persona.
echo "<h1>Función que recibe una fecha de nacimiento y calcula la edad</h1>";

function calcularEdad($fechaNacimiento) {
    // Crear un objeto DateTime para la fecha de nacimiento
    try {
        $fechaNac = DateTime::createFromFormat('d-m-Y', $fechaNacimiento);
        if (!$fechaNac) {
            throw new Exception("Formato de fecha no válido.");
        }
    } catch (Exception $e) {
        return "Error: " . $e->getMessage();
    }

    // Crear un objeto DateTime para la fecha actual
    $fechaActual = new DateTime();

    // Calcular la diferencia entre las dos fechas
    $diferencia = $fechaActual->diff($fechaNac);

    // Obtener la edad a partir de la diferencia
    return $diferencia->y; // y = años de diferencia
}

// Ejemplo de uso
$fechaNacimiento = "22-09-1976";
$edad = calcularEdad($fechaNacimiento);

echo "La edad de la persona es: " . $edad . " años.";

echo $separador;

// 15.	Crea una función que reciba el precio de un producto y un porcentaje de descuento, devolviendo el precio final con el descuento aplicado.
echo "<h1>Función que recibe el precio de un producto y descuento y devuelve el precio final</h1>";

function calcularDescuento($precio, $descuento){
    // Calcular el monto del descuento
    $montoDescuento = $precio * ($descuento / 100);
    
    // Calcular el precio final
    $precioFinal = $precio - $montoDescuento;
    
    return $precioFinal;
}

echo "Un producto que cuesta 100€ y tiene un 12% de desuento, su valor final es: " . calcularDescuento(100, 12);

echo $separador;

// 16.	Crea una función que reciba un precio base y calcule el IVA y proporcione el precio final IVA incluido.
echo "<h1>Función que calcula el IVA</h1>";

function calcularPrecioConIVA($precio, $iva){
    // Calcular el monto del IVA
    $montoIVA = $precio * ($iva / 100);

    // Calcular el precio final con IVA incluido
    $precioFinal = $precio + $iva;

    return [
        'precio_base' => $precio,
        'porcentaje_iva' => $iva,
        'monto_iva' => $montoIVA,
        'precio_final' => $precioFinal,
    ];
}

$precio = 100; // Precio base del producto
$iva = 21; // Porcentaje de IVA (21% por defecto)
$resultado = calcularPrecioConIVA($precio, $iva);

echo "Precio base: " . number_format($resultado['precio_base'], 2) . "€<br>";
echo "IVA (" . $resultado['porcentaje_iva'] . "%): " . number_format($resultado['monto_iva'], 2) . "€<br>";
echo "Precio final (IVA incluido): $" . number_format($resultado['precio_final'], 2);


?>

</body>

</html>