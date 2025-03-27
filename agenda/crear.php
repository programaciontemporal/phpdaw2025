<?php
require 'conexion.php';
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php?error=Debes+iniciar+sesión+para+acceder+a+esta+página");
    exit;
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Validar y sanitizar
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
        
        if (empty($nombre) || empty($telefono) || empty($email)) {
            throw new Exception("Todos los campos son obligatorios");
        }
        
        if (!preg_match('/^[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,50}$/', $nombre)) {
            throw new Exception("El nombre no tiene un formato válido");
        }
        
        if (!preg_match('/^[0-9+()\s-]{6,20}$/', $telefono)) {
            throw new Exception("El teléfono no tiene un formato válido");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("El email no tiene un formato válido");
        }
        
        // Insertar en la base de datos
        $stmt = $pdo->prepare("INSERT INTO contactos (nombre, email, telefono) VALUES (?, ?, ?)");
        $stmt->execute([$nombre, $email, $telefono]);
        
        // Redirigir con mensaje de éxito
        header("Location: index.php?success=Contacto+creado+correctamente");
        exit();
        
    } catch (Exception $e) {
        // Registrar error y redirigir con mensaje
        error_log("Error al crear contacto: " . $e->getMessage());
        header("Location: index.php?error=" . urlencode($e->getMessage()));
        exit();
    }
}

// Si no es POST, redirigir
header("Location: index.php");
exit();
?>