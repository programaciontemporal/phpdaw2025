<!DOCTYPE html>
<html>
<head>
    <title>Seleccionar Color</title>
</head>
<body style="background-color: <?php echo isset($_COOKIE['color']) ? $_COOKIE['color'] : 'white'; ?>;">

    <h2>Selecciona un color de fondo</h2>
    <form method="post" action="guardar_color.php">
        <select name="color">
            <option value="white">Blanco</option>
            <option value="blue">Azul</option>
            <option value="red">Rojo</option>
            <option value="green">Verde</option>
            <option value="yellow">Amarillo</option>
        </select>
        <input type="submit" value="Guardar Color">
    </form>

</body>
</html>
