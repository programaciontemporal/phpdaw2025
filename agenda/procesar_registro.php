<?php
require 'conexion.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitización de entradas
    $nombre = htmlspecialchars(trim($_POST['nombre'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    // Validaciones
    $errores = [];
    
    if (strlen($nombre) < 3) {
        $errores[] = 'El nombre debe tener al menos 3 caracteres';
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errores[] = 'El email no tiene un formato válido';
    }
    
    if (strlen($password) < 8) {
        $errores[] = 'La contraseña debe tener al menos 8 caracteres';
    } elseif ($password !== $confirm_password) {
        $errores[] = 'Las contraseñas no coinciden';
    }
    
    // Procesar si no hay errores
    if (empty($errores)) {
        try {
            // Verificar email único
            $consulta = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
            $consulta->execute([$email]);
            
            if ($consulta->rowCount() > 0) {
                $errores[] = 'Este email ya está registrado';
            } else {
                // Insertar con todos los campos
                $sql = "INSERT INTO usuarios 
                        (nombre, email, password, fecha_registro, activo) 
                        VALUES (?, ?, ?, NOW(), 1)";
                
                $stmt = $pdo->prepare($sql);
                $password_hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt->execute([$nombre, $email, $password_hash]);
                
                // Iniciar sesión automáticamente
                $_SESSION['usuario_id'] = $pdo->lastInsertId();
                $_SESSION['usuario_nombre'] = $nombre;
                
                header("Location: dashboard.php");
                exit;
            }
        } catch (PDOException $e) {
            error_log("Error en registro: " . $e->getMessage());
            $errores[] = 'Error en el sistema. Por favor intente más tarde.';
        }
    }
    
    // Guardar errores para mostrarlos
    if (!empty($errores)) {
        $_SESSION['errores_registro'] = $errores;
        $_SESSION['datos_registro'] = compact('nombre', 'email');
        header("Location: registro.php");
        exit;
    }
}

header("Location: registro.php");
exit;
?>