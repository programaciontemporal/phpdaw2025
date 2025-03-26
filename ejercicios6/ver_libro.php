<?php
require 'conexion.php';

// Validar y obtener ID
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id) {
    header("Location: listado.php?error=invalid_id");
    exit();
}

// Obtener datos del libro
$stmt = $pdo->prepare("SELECT * FROM libros WHERE id_libro = ?");
$stmt->execute([$id]);
$libro = $stmt->fetch();

if (!$libro) {
    header("Location: listado.php?error=book_not_found");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($libro['titulo']) ?> | Biblioteca</title>
    <!-- Bootstrap Lux Theme -->
    <link rel="stylesheet" href="https://bootswatch.com/5/lux/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .book-cover-hero {
            width: 200px;
            height: 300px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 5rem;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            margin: 0 auto;
        }
        .detail-card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s;
        }
        .detail-card:hover {
            transform: translateY(-5px);
        }
        .back-btn {
            transition: all 0.3s;
        }
        .back-btn:hover {
            transform: translateX(-3px);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="listado.php">
                <i class="fas fa-book-open me-2"></i>Biblioteca Digital
            </a>
            <div class="navbar-nav ms-auto">
                <a href="listado.php" class="btn btn-sm btn-outline-light back-btn">
                    <i class="fas fa-arrow-left me-1"></i> Volver al listado
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="detail-card card border-0">
                    <div class="card-header bg-white text-center py-4">
                        <div class="book-cover-hero mb-4">
                            <?= substr(htmlspecialchars($libro['titulo']), 0, 1) ?>
                        </div>
                        <h1 class="display-5 fw-bold"><?= htmlspecialchars($libro['titulo']) ?></h1>
                        <p class="text-muted mb-0">por <?= htmlspecialchars($libro['autor']) ?></p>
                    </div>
                    
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <h5 class="text-primary"><i class="fas fa-user-pen me-2"></i>Autor</h5>
                                    <p class="fs-5"><?= htmlspecialchars($libro['autor']) ?></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <h5 class="text-primary"><i class="fas fa-calendar-alt me-2"></i>Año de publicación</h5>
                                    <p class="fs-5"><?= $libro['anio'] ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="text-primary"><i class="fas fa-fingerprint me-2"></i>ID del Libro</h5>
                            <p class="fs-5"><?= $libro['id_libro'] ?></p>
                        </div>

                        <div class="d-flex justify-content-center gap-3 mt-5">
                            <a href="listado.php" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left me-1"></i> Volver
                            </a>
                            <a href="editar_libro.php?id_libro=<?= $libro['id_libro'] ?>" class="btn btn-primary">
                                <i class="fas fa-edit me-1"></i> Editar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0 text-muted">
                <i class="fas fa-book-reader me-1"></i> Sistema de Gestión Bibliotecaria
            </p>
            <small class="text-muted">© <?= date('Y') ?> Todos los derechos reservados</small>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>