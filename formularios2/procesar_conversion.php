<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Conversión</title>
</head>
<body>
    <h1>Resultado de Conversión</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $temperatura = floatval($_POST['temperatura']);
        $unidad_origen = $_POST['unidad_origen'];

        // Realizar la conversión
        if ($unidad_origen == "celsius") {
            $fahrenheit = ($temperatura * 9 / 5) + 32;
            echo "<p>$temperatura °C equivale a $fahrenheit °F</p>";
        } else {
            $celsius = ($temperatura - 32) * 5 / 9;
            echo "<p>$temperatura °F equivale a $celsius °C</p>";
        }
    } else {
        echo "<p>No se han recibido datos.</p>";
    }
    ?>
    <a href="conversor.php">Volver al formulario</a>
</body>
</html>