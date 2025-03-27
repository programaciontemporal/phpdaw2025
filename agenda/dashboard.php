<?php
require 'conexion.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT nombre, email, fecha_registro FROM usuarios WHERE id = ?");
    $stmt->execute([$_SESSION['usuario_id']]);
    $usuario = $stmt->fetch();
} catch (PDOException $e) {
    error_log('Error al obtener datos de usuario: ' . $e->getMessage());
    die('Error al cargar los datos del usuario');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .dashboard-container { max-width: 1200px; margin: 2rem auto; padding: 0 1rem; }
        .user-card { background-color: white; border-radius: 0.5rem; box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1); padding: 2rem; margin-bottom: 2rem; }
        .user-card h2 { color: var(--primary-color); margin-bottom: 1rem; }
        .user-info p { margin-bottom: 0.5rem; font-size: 1.1rem; }
        .logout-btn { display: inline-block; margin-top: 1.5rem; padding: 0.5rem 1.5rem; background-color: var(--danger-color); color: white; border-radius: 0.35rem; text-decoration: none; }
        .action-btns { margin-top: 2rem; display: flex; gap: 1rem; }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="user-card">
            <h2>Bienvenido, <?php echo htmlspecialchars($usuario['nombre']); ?></h2>
            <div class="user-info">
                <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
                <p><strong>Fecha de registro:</strong> <?php echo date('d/m/Y', strtotime($usuario['fecha_registro'])); ?></p>
            </div>
            
            <div class="action-btns">
                <a href="index.php" class="btn btn-primary">Ir a Agenda</a>
                <a href="logout.php" class="logout-btn">Cerrar Sesión</a>
            </div>
        </div>
    </div>
</body>
</html>