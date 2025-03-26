<?php

include 'conexion.php';

// Parámetros de búsqueda
$busqueda = $_GET['busqueda'] ?? '';
$registrosPorPagina = 10;
$pagina = filter_input(INPUT_GET, 'pagina', FILTER_VALIDATE_INT, [
    'options' => ['default' => 1, 'min_range' => 1]
]);

// Consulta base con búsqueda
$query = "SELECT * FROM libros";
$queryCount = "SELECT COUNT(*) FROM libros";
$params = [];
$where = '';

if (!empty($busqueda)) {
    $where = " WHERE titulo LIKE :busqueda OR autor LIKE :busqueda";
    $params[':busqueda'] = "%$busqueda%";
}

// Consulta para el total (con búsqueda si aplica)
$stmtCount = $pdo->prepare($queryCount . $where);
foreach ($params as $key => $value) {
    $stmtCount->bindValue($key, $value);
}
$stmtCount->execute();
$totalRegistros = $stmtCount->fetchColumn();

// Consulta paginada
$offset = ($pagina - 1) * $registrosPorPagina;
$query .= $where . " ORDER BY titulo LIMIT :offset, :limit";
$stmt = $pdo->prepare($query);

// Bind parameters
foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', $registrosPorPagina, PDO::PARAM_INT);
$stmt->execute();
$libros = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calcular rangos
$inicio = $offset + 1;
$fin = min($offset + $registrosPorPagina, $totalRegistros);
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Libros</title>
    <link rel="stylesheet" href="https://bootswatch.com/5/lux/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .book-cover {
            width: 60px;
            height: 80px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            border-radius: 4px;
            margin-right: 15px;
        }
        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #dee2e6;
        }
        .table-hover tbody tr:hover {
            background-color: rgba(106, 17, 203, 0.05);
        }
        .action-btn {
            opacity: 0.7;
            transition: all 0.3s;
        }
        .action-btn:hover {
            opacity: 1;
            transform: scale(1.1);
        }
        .pagination .page-item.active .page-link {
            background-color: #6a11cb;
            border-color: #6a11cb;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="listado.php">
                <i class="fas fa-book me-2"></i> Biblioteca Digital
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <div class="navbar-nav ms-auto">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addBookModal">
                    <i class="fas fa-plus-circle me-1"></i> Añadir Libro
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2 class="display-6"><i class="fas fa-book-open me-2"></i>Catálogo de Libros</h2>
                <p class="text-muted">Explora nuestra colección literaria</p>
            </div>
            <div class="col-md-6">
                <form method="get" action="listado.php" class="d-flex">
                    <input type="text" name="busqueda" class="form-control me-2" 
                        placeholder="Buscar por título o autor..." 
                        value="<?= htmlspecialchars($_GET['busqueda'] ?? '') ?>">
                    <input type="hidden" name="pagina" value="1"> <!-- Resetear a página 1 al buscar -->
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                    <?php if(isset($_GET['busqueda'])): ?>
                        <a href="listado.php" class="btn btn-outline-danger ms-2">
                            <i class="fas fa-times"></i>
                        </a>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <?php if(!empty($busqueda)): ?>
            <div class="alert alert-primary d-flex justify-content-between align-items-center mb-4">
                <div>
                    <i class="fas fa-search me-2"></i>
                    Resultados para "<strong><?= htmlspecialchars($busqueda) ?></strong>":
                    <span class="ms-2">
                        <span class="badge bg-dark"><?= $inicio ?>-<?= $fin ?></span> de 
                        <span class="badge bg-success"><?= $totalRegistros ?></span> libros
                    </span>
                </div>
                <a href="listado.php" class="btn btn-sm btn-outline-danger">
                    <i class="fas fa-times me-1"></i> Limpiar
                </a>
            </div>
        <?php endif; ?>

        <!-- Libros Table -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0 pt-4">
                <h5 class="mb-0"><i class="fas fa-list-ul me-2"></i>Registros</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Título</th>
                                <th>Autor</th>
                                <th>Año</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($libros as $libro): ?>
                                <tr>
                                <td><strong><?= htmlspecialchars($libro['titulo']) ?></strong></td>
                                <td><?= htmlspecialchars($libro['autor']) ?></td>
                                <td><?= $libro['anio'] ?></td>
                                <td class="text-end">
                                    <div class="btn-group">
                                        <!-- Botón Ver (ahora abre modal) -->
                                        <button class="btn btn-sm btn-outline-primary action-btn view-btn" 
                                                title="Ver"
                                                data-id="<?= $libro['id_libro'] ?>"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#viewModal">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        
                                        <!-- Botón Editar -->
                                        <button class="btn btn-sm btn-outline-secondary action-btn edit-btn" 
                                                title="Editar"
                                                data-id="<?= $libro['id_libro'] ?>"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editarModal">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        
                                        <!-- Botón Eliminar -->
                                        <button class="btn btn-sm btn-outline-danger action-btn delete-btn" 
                                                title="Eliminar"
                                                data-id="<?= $libro['id_libro'] ?>">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Paginación -->
            <div class="card-footer bg-white border-0">
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <li class="page-item <?= $pagina <= 1 ? 'disabled' : '' ?>">
                            <a class="page-link" href="?pagina=<?= $pagina - 1 ?>&busqueda=<?= urlencode($busqueda) ?>">
                                <i class="fas fa-chevron-left"></i>
                            </a>
                        </li>
                        
                        <?php for ($i = 1; $i <= $totalPaginas; $i++): ?>
                            <li class="page-item <?= $i == $pagina ? 'active' : '' ?>">
                                <a class="page-link" href="?pagina=<?= $i ?>&busqueda=<?= urlencode($busqueda) ?>">
                                    <?= $i ?>
                                </a>
                            </li>
                        <?php endfor; ?>
                        
                        <li class="page-item <?= $pagina >= $totalPaginas ? 'disabled' : '' ?>">
                            <a class="page-link" href="?pagina=<?= $pagina + 1 ?>&busqueda=<?= urlencode($busqueda) ?>">
                                <i class="fas fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>

                <p class="text-center text-muted mt-2">
                    Página <?= $pagina ?> de <?= $totalPaginas ?> | 
                    Registros <?= $inicio ?>-<?= $fin ?> de <?= $totalRegistros ?>
                </p>
            </div>
        </div>
    </div>

    <!-- Modal Añadir Libro -->
    <div class="modal fade" id="addBookModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title"><i class="fas fa-book-medical me-2"></i> Nuevo Libro</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form id="addBookForm" method="post" action="guardar_libro.php">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="titulo" class="form-label">Título *</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" required>
                        </div>
                        <div class="mb-3">
                            <label for="autor" class="form-label">Autor *</label>
                            <input type="text" class="form-control" id="autor" name="autor" required>
                        </div>
                        <div class="mb-3">
                            <label for="anio" class="form-label">Año *</label>
                            <input type="number" class="form-control" id="anio" name="anio" min="1000" max="<?= date('Y') ?>" required>
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i> Cancelar
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-1"></i> Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal para Ver Detalles -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fas fa-book-open me-2"></i> Detalles del Libro</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4" id="modal-view-body">
                    <!-- Contenido cargado dinámicamente via AJAX -->
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary"></div>
                        <p class="mt-3">Cargando detalles...</p>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Cerrar
                    </button>
                    <!-- <a href="#" id="edit-book-link" class="btn btn-primary">
                        <i class="fas fa-edit me-1"></i> Editar
                    </a> -->
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar -->
    <div class="modal fade" id="editarModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Editar Libro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modal-editar-body">
                    <!-- Cargado via AJAX -->
                    <div class="text-center my-4">
                        <div class="spinner-border text-primary"></div>
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

    <script>
        // ----------------------------
        // 
        // ----------------------------
        // Manejo del formulario de añadir libro
        document.getElementById('addBookForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            
            // Mostrar spinner
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Guardando...';
            submitBtn.disabled = true;
            
            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cerrar modal y recargar datos
                    bootstrap.Modal.getInstance(document.getElementById('addBookModal')).hide();
                    showToast('Libro añadido correctamente', 'success');
                    setTimeout(() => location.reload(), 1500); // Recargar para ver cambios
                } else {
                    throw new Error(data.message || 'Error desconocido');
                }
            })
            .catch(error => {
                showToast(error.message, 'danger');
            })
            .finally(() => {
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
            });
        });

        // ----------------------------
        // Script para VER los detalles del libro
        // ----------------------------
        document.querySelectorAll('.view-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const modalBody = document.getElementById('modal-view-body');
                //const editLink = document.getElementById('edit-book-link');
                
                // Mostrar spinner mientras carga
                modalBody.innerHTML = `
                    <div class="text-center py-5">
                        <div class="spinner-border text-primary"></div>
                        <p class="mt-3">Cargando detalles...</p>
                    </div>`;
                
                // Cargar contenido via AJAX
                fetch(`obtener_detalles_libro.php?id=${id}`)
                    .then(response => {
                        if (!response.ok) throw new Error('Error al cargar');
                        return response.text();
                    })
                    .then(html => {
                        modalBody.innerHTML = html;
                        // editLink.href = `editar_libro.php?id=${id}`;
                    })
                    .catch(error => {
                        modalBody.innerHTML = `
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle me-2"></i>
                                ${error.message}
                            </div>`;
                    });
            });
        });
        // ----------------------------
        // Script para EDITAR (Modal + AJAX)
        // ----------------------------
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.edit-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    fetch(`editar_libro.php?id=${id}`)
                        .then(response => {
                            if (!response.ok) throw new Error('Error al cargar datos');
                            return response.text();
                        })
                        .then(html => {
                            document.getElementById('modal-editar-body').innerHTML = html;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            document.getElementById('modal-editar-body').innerHTML = `
                                <div class="alert alert-danger">
                                    ${error.message}
                                </div>`;
                        });
                });
            });

            // ----------------------------
            // Script para ELIMINAR (Confirmación + AJAX)
            // ----------------------------
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const fila = this.closest('tr');
                    
                    if (confirm('¿Estás seguro de eliminar este libro? Esta acción no se puede deshacer.')) {
                        fetch(`eliminar_libro.php?id=${id}`, { 
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' }
                        })
                        .then(response => {
                            if (!response.ok) throw new Error('Error en la respuesta del servidor');
                            return response.json();
                        })
                        .then(data => {
                            if (data.success) {
                                // Eliminar fila visualmente con animación
                                fila.style.transition = 'all 0.3s';
                                fila.style.opacity = '0';
                                setTimeout(() => fila.remove(), 300);
                                
                                // Mostrar notificación
                                showToast('Libro eliminado correctamente', 'success');
                            } else {
                                throw new Error(data.message || 'Error desconocido');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            showToast(error.message, 'danger');
                        });
                    }
                });
            });

            // Función auxiliar para notificaciones Toast
            function showToast(message, type = 'success') {
                // Implementa tu sistema de notificaciones aquí
                console.log(`${type}: ${message}`);
                // Ejemplo con Bootstrap Toast:
                const toastEl = document.getElementById('liveToast');
                if (toastEl) {
                    const toast = new bootstrap.Toast(toastEl);
                    toastEl.querySelector('.toast-body').textContent = message;
                    toastEl.classList.add(`text-bg-${type}`);
                    toast.show();
                }
            }
        });
    </script>
</body>
</html>