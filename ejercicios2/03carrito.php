<?php
session_start(); // Iniciar la sesión

if (!isset($_SESSION["carrito"])) {
    $_SESSION["carrito"] = []; // Inicializar el carrito si no existe
}

$carrito = $_SESSION["carrito"];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Carrito de Compras</title>
</head>
<body>
    <h1>Carrito de Compras</h1>

    <?php if (empty($carrito)): ?>
        <p>No hay productos en el carrito.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($carrito as $producto): ?>
                <li><?php echo htmlspecialchars($producto); ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <form method="post" action="03procesar_carrito.php">
        <input type="submit" name="accion" value="Vaciar carrito">
    </form>

    <br>
    <a href="03index.php">Seguir comprando</a>
</body>
</html>