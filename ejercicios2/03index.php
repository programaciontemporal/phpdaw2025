<?php
session_start(); // Iniciar la sesión
?>

<!DOCTYPE html>
<html>
<head>
    <title>Carrito de Compras</title>
</head>
<body>
    <h1>Productos Disponibles</h1>
    <form method="post" action="03procesar_carrito.php">
        <ul>
            <li>
                <input type="checkbox" name="productos[]" value="Camiseta - 20€"> Camiseta - 20€
            </li>
            <li>
                <input type="checkbox" name="productos[]" value="Pantalón - 40€"> Pantalón - 40€
            </li>
            <li>
                <input type="checkbox" name="productos[]" value="Zapatos - 60€"> Zapatos - 60€
            </li>
            <li>
                <input type="checkbox" name="productos[]" value="Gorra - 15€"> Gorra - 15€
            </li>
            <li>
                <input type="checkbox" name="productos[]" value="Bufanda - 12€"> Bufanda - 12€
            </li>
            <li>
                <input type="checkbox" name="productos[]" value="Chaqueta - 80€"> Chaqueta - 80€
            </li>
            <li>
                <input type="checkbox" name="productos[]" value="Reloj - 100€"> Reloj - 100€
            </li>
            <li>
                <input type="checkbox" name="productos[]" value="Mochila - 35€"> Mochila - 35€
            </li>
            <li>
                <input type="checkbox" name="productos[]" value="Gafas de sol - 25€"> Gafas de sol - 25€
            </li>
            <li>
                <input type="checkbox" name="productos[]" value="Bolso - 50€"> Bolso - 50€
            </li>
            <li>
                <input type="checkbox" name="productos[]" value="Cinturón - 18€"> Cinturón - 18€
            </li>
            <li>
                <input type="checkbox" name="productos[]" value="Calcetines - 8€"> Calcetines - 8€
            </li>
            <li>
                <input type="checkbox" name="productos[]" value="Sombrero - 22€"> Sombrero - 22€
            </li>
            <li>
                <input type="checkbox" name="productos[]" value="Guantes - 10€"> Guantes - 10€
            </li>
            <li>
                <input type="checkbox" name="productos[]" value="Vestido - 70€"> Vestido - 70€
            </li>
            <li>
                <input type="checkbox" name="productos[]" value="Falda - 30€"> Falda - 30€
            </li>
            <li>
                <input type="checkbox" name="productos[]" value="Corbata - 15€"> Corbata - 15€
            </li>
            <li>
                <input type="checkbox" name="productos[]" value="Pijama - 25€"> Pijama - 25€
            </li>
            <li>
                <input type="checkbox" name="productos[]" value="Zapatillas - 45€"> Zapatillas - 45€
            </li>
            <li>
                <input type="checkbox" name="productos[]" value="Chaleco - 28€"> Chaleco - 28€
            </li>
        </ul>
        <input type="submit" name="accion" value="Agregar al carrito">
    </form>

    <br>
    <a href="03carrito.php">Ver carrito</a>
</body>
</html>