<!DOCTYPE html>
<html>
<head>
    <title>Calculadora PHP</title>
</head>
<body>
    <h2>Calculadora</h2>
    <form method="post" action="procesar_calculo.php">
        Número 1: <input type="number" name="num1" required><br><br>
        Número 2: <input type="number" name="num2" required><br><br>
        Operación:
        <select name="operacion">
            <option value="suma">Suma</option>
            <option value="resta">Resta</option>
            <option value="multiplicacion">Multiplicación</option>
            <option value="division">División</option>
        </select><br><br>
        <input type="submit" value="Calcular">
    </form>
</body>
</html>
