<?php
require 'conexion.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) die('<div class="alert alert-danger">ID inválido</div>');

$stmt = $pdo->prepare("SELECT * FROM libros WHERE id_libro = ?");
$stmt->execute([$id]);
$libro = $stmt->fetch();

if (!$libro) die('<div class="alert alert-danger">Libro no encontrado</div>');
?>

<div class="row">
    <div class="col-md-4 text-center">
        <div class="book-cover-modal mb-4">
            <?= substr(htmlspecialchars($libro['titulo']), 0, 1) ?>
        </div>
        <h4 class="fw-bold"><?= htmlspecialchars($libro['titulo']) ?></h4>
        <p class="text-muted">por <?= htmlspecialchars($libro['autor']) ?></p>
    </div>
    
    <div class="col-md-8">
        <div class="border-start ps-4">
            <div class="mb-4">
                <h5 class="text-primary d-flex align-items-center">
                    <i class="fas fa-user-pen me-2"></i> Autor
                </h5>
                <p><?= htmlspecialchars($libro['autor']) ?></p>
            </div>
            
            <div class="mb-4">
                <h5 class="text-primary d-flex align-items-center">
                    <i class="fas fa-calendar-alt me-2"></i> Año
                </h5>
                <p><?= $libro['anio'] ?></p>
            </div>
            
            <div class="mb-4">
                <h5 class="text-primary d-flex align-items-center">
                    <i class="fas fa-fingerprint me-2"></i> ID
                </h5>
                <p><?= $libro['id_libro'] ?></p>
            </div>
        </div>
    </div>
</div>

<style>
    .book-cover-modal {
        width: 150px;
        height: 200px;
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        border-radius: 8px;
        margin: 0 auto;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
</style>