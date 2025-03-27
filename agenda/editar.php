<?php
require 'conexion.php';
session_start();

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: index.php?error=ID+de+contacto+inválido");
    exit();
}

try {
    // Obtener contacto
    $stmt = $pdo->prepare("SELECT * FROM contactos WHERE id = ?");
    $stmt->execute([$id]);
    $contacto = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$contacto) {
        throw new Exception("Contacto no encontrado");
    }
    
    // Procesar actualización
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nombre = filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_STRING);
        $telefono = filter_input(INPUT_POST, 'telefono', FILTER_SANITIZE_STRING);
        
        if (empty($nombre) || empty($telefono)) {
            throw new Exception("Todos los campos son obligatorios");
        }
        
        $stmt = $pdo->prepare("UPDATE contactos SET nombre = ?, telefono = ? WHERE id = ?");
        $stmt->execute([$nombre, $telefono, $id]);
        
        header("Location: index.php?success=Contacto+actualizado+correctamente");
        exit();
    }
    
} catch (Exception $e) {
    error_log("Error en editar.php: " . $e->getMessage());
    header("Location: index.php?error=" . urlencode($e->getMessage()));
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Contacto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold"><i class="fas fa-edit me-2"></i>Editar Contacto</h6>
                    </div>
                    <div class="card-body">
                        <?php if (isset($_GET['error'])): ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <?= htmlspecialchars($_GET['error']) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        
                        <form method="POST">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required
                                       value="<?= htmlspecialchars($contacto['nombre']) ?>"
                                       pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,50}" 
                                       title="Solo letras y espacios (2-50 caracteres)">
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="tel" class="form-control" id="telefono" name="telefono" required
                                       value="<?= htmlspecialchars($contacto['telefono']) ?>"
                                       pattern="[0-9+()\s-]{6,20}" 
                                       title="Formato de teléfono válido (6-20 caracteres)">
                            </div>
                            <div class="d-flex justify-content-end">
                                <a href="index.php" class="btn btn-secondary me-2">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Actualizar Contacto</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>