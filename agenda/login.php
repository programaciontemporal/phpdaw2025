<?php
require 'conexion.php';
// Verificar estado de sesión primero
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


// Redirigir si ya está logueado
if (isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

// Manejar el formulario de login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Email no válido';
    } elseif (empty($password)) {
        $error = 'La contraseña es requerida';
    } else {
        try {
            $stmt = $pdo->prepare("SELECT id, nombre, password FROM usuarios WHERE email = ? AND activo = 1");
            $stmt->execute([$email]);
            
            if ($usuario = $stmt->fetch()) {
                if (password_verify($password, $usuario['password'])) {
                    // Iniciar sesión
                    $_SESSION['usuario_id'] = $usuario['id'];
                    $_SESSION['usuario_nombre'] = $usuario['nombre'];
                    
                    // Cookie de "recordarme"
                    if ($remember) {
                        $token = bin2hex(random_bytes(32));
                        $expiry = time() + 60 * 60 * 24 * 30; // 30 días
                        
                        setcookie('remember_token', $token, $expiry, '/');
                        
                        // Guardar token en la base de datos
                        $stmt = $pdo->prepare("UPDATE usuarios SET remember_token = ?, token_expiry = ? WHERE id = ?");
                        $stmt->execute([$token, date('Y-m-d H:i:s', $expiry), $usuario['id']]);
                    }
                    
                    header("Location: index.php");
                    exit;
                }
            }
            
            $error = 'Credenciales incorrectas';
        } catch (PDOException $e) {
            error_log("Error en login: " . $e->getMessage());
            $error = 'Error en el sistema. Intente más tarde.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .auth-container { max-width: 500px; margin: 5rem auto; }
        .auth-card { border-radius: 0.5rem; box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15); }
        .auth-header { background-color: var(--primary-color); color: white; border-radius: 0.5rem 0.5rem 0 0; padding: 1.5rem; text-align: center; }
        .auth-body { padding: 2rem; background-color: white; border-radius: 0 0 0.5rem 0.5rem; }
        .form-group { margin-bottom: 1.5rem; }
        .auth-footer { text-align: center; margin-top: 1.5rem; }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h2>Iniciar Sesión</h2>
            </div>
            <div class="auth-body">
                <?php if (isset($_GET['mensaje'])): ?>
                    <div class="alert alert-<?php echo $_GET['tipo'] ?? 'success'; ?>">
                        <?php echo htmlspecialchars($_GET['mensaje']); ?>
                    </div>
                <?php endif; ?>
                
                <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                
                <form method="POST">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" class="form-control login-control flat-input" 
                               value="<?php echo htmlspecialchars($email ?? ''); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" class="form-control login-control flat-input" required>
                    </div>
                    
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Recordarme</label>
                    </div>
                    
                    <div class="form-grouop text-white">
                        <button class="btn btn-primary py-2 text-white">Ingresar</button>
                    </div>
                </form>
                
                <div class="auth-footer">
                    ¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>