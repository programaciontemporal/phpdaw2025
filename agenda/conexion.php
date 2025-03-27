<?php
$host = 'localhost';
$dbname = 'agenda_db';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    
    if (!isset($_SESSION['usuario_id']) && isset($_COOKIE['remember_token'])) {
        $token = $_COOKIE['remember_token'];
        $stmt = $pdo->prepare("SELECT id, nombre FROM usuarios WHERE remember_token = ? AND token_expiry > NOW()");
        $stmt->execute([$token]);
        
        if ($usuario = $stmt->fetch()) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre'];
        }
    }
} catch (PDOException $e) {
    error_log('Error de conexión: ' . $e->getMessage());
    die('Error al conectar con la base de datos. Por favor, inténtelo más tarde.');
}
?>