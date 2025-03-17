<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversor de Temperaturas</title>
</head>
<body>
    <h1>Conversor de Temperaturas</h1>
    <form action="procesar_conversion.php" method="post">
        <label for="temperatura">Temperatura:</label><br>
        <input type="number" step="0.1" id="temperatura" name="temperatura" required><br><br>

        <label for="unidad_origen">Convertir de:</label><br>
        <select id="unidad_origen" name="unidad_origen" required>
            <option value="celsius">Celsius a Fahrenheit</option>
            <option value="fahrenheit">Fahrenheit a Celsius</option>
        </select><br><br>

        <input type="submit" value="Convertir">
    </form>
</body>
</html>