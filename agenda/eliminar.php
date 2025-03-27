<?php
require_once 'conexion.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    header("Location: index.php?error=ID+de+contacto+inválido");
    exit();
}

try {
    // Verificar si el contacto existe
    $stmt = $pdo->prepare("SELECT id FROM contactos WHERE id = ?");
    $stmt->execute([$id]);
    
    if (!$stmt->fetch()) {
        throw new Exception("El contacto no existe");
    }
    
    // Eliminar el contacto
    $stmt = $pdo->prepare("DELETE FROM contactos WHERE id = ?");
    $stmt->execute([$id]);
    
    header("Location: index.php?success=Contacto+eliminado+correctamente");
    exit();
    
} catch (Exception $e) {
    error_log("Error al eliminar contacto: " . $e->getMessage());
    header("Location: index.php?error=" . urlencode($e->getMessage()));
    exit();
}
?>