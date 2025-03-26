<?php
require 'conexion.php';
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$stmt = $pdo->prepare("SELECT * FROM libros WHERE id_libro = ?");
$stmt->execute([$id]);
$libro = $stmt->fetch();

// Formulario de edición
?>
<form action="actualizar_libro.php" method="post">
    <input type="hidden" name="id" value="<?= $libro['id_libro'] ?>">
    
    <div class="mb-3">
        <label class="form-label">Título</label>
        <input type="text" name="titulo" class="form-control" value="<?= htmlspecialchars($libro['titulo']) ?>" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Autor</label>
        <input type="text" name="autor" class="form-control" value="<?= htmlspecialchars($libro['autor']) ?>" required>
    </div>
    
    <div class="mb-3">
        <label class="form-label">Año</label>
        <input type="number" name="anio" class="form-control" value="<?= $libro['anio'] ?>" required>
    </div>
    
    <div class="text-end">
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </div>
</form>