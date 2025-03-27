<?php
// Añadir al inicio de index.php
require 'conexion.php';
session_start();

// Verificar sesión
if (!isset($_SESSION['usuario_id'])) {
    header('Location: login.php');
    exit;
}

// Configuración de paginación
$registrosPorPagina = isset($_GET['registros']) ? (int)$_GET['registros'] : 10;
$paginaActual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$offset = ($paginaActual - 1) * $registrosPorPagina;

// Manejar búsqueda
$busqueda = isset($_GET['buscar']) ? '%'.trim($_GET['buscar']).'%' : '%';

// Consulta para obtener contactos con paginación
$sql = "SELECT * FROM contactos WHERE nombre LIKE ? ORDER BY nombre ASC";
if ($registrosPorPagina > 0) {
    $sql .= " LIMIT $registrosPorPagina OFFSET $offset";
}

$stmt = $pdo->prepare($sql);
$stmt->execute([$busqueda]);

// Contar total de contactos (para búsqueda)
$sqlTotal = "SELECT COUNT(*) FROM contactos WHERE nombre LIKE ?";
$stmtTotal = $pdo->prepare($sqlTotal);
$stmtTotal->execute([$busqueda]);
$totalFiltrado = $stmtTotal->fetchColumn();

// Contar total de contactos (sin filtro)
$total = $pdo->query("SELECT COUNT(*) FROM contactos")->fetchColumn();
$totalPaginas = $registrosPorPagina > 0 ? ceil($totalFiltrado / $registrosPorPagina) : 1;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda de Contactos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <h6 class="m-0 font-weight-bold">
                            <a href="index.php" class="text-white text-decoration-none">
                                <i class="fas fa-address-book me-2"></i>Agenda de Contactos
                            </a>
                        </h6>
                        
                        <!-- Mostrar nombre del usuario -->
                        <?php if (isset($_SESSION['usuario_nombre'])): ?>
                            <span class="badge bg-light text-dark ms-3">
                                <i class="fas fa-user me-1"></i>
                                <?= htmlspecialchars($_SESSION['usuario_nombre']) ?>
                            </span>
                        <?php endif; ?>
                    </div>

                    <div class="d-flex align-items-center">
                        <!-- Contador de contactos (se mantiene igual) -->
                        <span class="badge bg-light text-dark me-3">
                            <i class="fas fa-users me-1"></i>
                            <span id="total-contactos"><?= $totalFiltrado ?></span> contactos
                            <?php if ($totalFiltrado != $total): ?>
                                (de <?= $total ?> totales)
                            <?php endif; ?>
                        </span>
                        
                        <!-- Botón Cerrar Sesión -->
                        <a href="logout.php" class="btn btn-sm btn-danger py-1">
                            <i class="fas fa-sign-out-alt me-1"></i> Salir
                        </a>
                    </div>
                </div>

                    <div class="card-body">
                        <?php if (isset($_GET['success'])): ?>
                            <div class="alert alert-success alert-dismissible fade show">
                                <?= htmlspecialchars($_GET['success']) ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>
                        
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <!-- Botón Nuevo Contacto -->
                            <button class="btn btn-primary py-2 text-white" data-bs-toggle="modal" data-bs-target="#nuevoContactoModal">
                                <i class="fas fa-plus-circle me-1 text-white"></i> Nuevo Contacto
                            </button>
                            
                            <!-- Contenedor de Búsqueda y Selector -->
                            <div class="d-flex align-items-center gap-2">
                                <!-- Campo de Búsqueda -->
                                <form method="GET" class="mb-0">
                                    <div class="input-group" style="width: 220px;">
                                        <span class="input-group-text bg-white"><i class="fas fa-search"></i></span>
                                        <input type="text" name="buscar" class="form-control py-2 rounded-end" 
                                            placeholder="Buscar..." 
                                            value="<?= isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : '' ?>">
                                        <input type="hidden" name="pagina" value="1">
                                    </div>
                                </form>
                                
                                <!-- Selector de Registros por Página -->
                                <div class="d-flex align-items-center">
                                    <span class="me-2 text-nowrap" style="font-size: 0.875rem;">Contactos por página:</span>
                                    <form method="GET" class="mb-0">
                                        <input type="hidden" name="pagina" value="1">
                                        <?php if(isset($_GET['buscar'])): ?>
                                            <input type="hidden" name="buscar" value="<?= htmlspecialchars($_GET['buscar']) ?>">
                                        <?php endif; ?>
                                        <select name="registros" class="form-select py-2" onchange="this.form.submit()" style="width: 140px;">
                                            <option value="10" <?= $registrosPorPagina == 10 ? 'selected' : '' ?>>10</option>
                                            <option value="20" <?= $registrosPorPagina == 20 ? 'selected' : '' ?>>20</option>
                                            <option value="50" <?= $registrosPorPagina == 50 ? 'selected' : '' ?>>50</option>
                                            <option value="100" <?= $registrosPorPagina == 100 ? 'selected' : '' ?>>100</option>
                                            <option value="0" <?= $registrosPorPagina == 0 ? 'selected' : '' ?>>Todos</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Teléfono</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($fila['nombre']) ?></td>
                                            <td><?= htmlspecialchars($fila['telefono']) ?></td>
                                            <td class="action-btns">
                                                <a href="editar.php?id=<?= $fila['id'] ?>" class="btn btn-sm btn-warning" title="Editar">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="eliminar.php?id=<?= $fila['id'] ?>" class="btn btn-sm btn-danger" 
                                                   title="Eliminar" onclick="return confirm('¿Estás seguro de eliminar este contacto?')">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginación -->
                        <?php if ($totalPaginas > 1 && $registrosPorPagina > 0): ?>
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center flex-wrap mt-4">
                                    <!-- Botón Primera Página - Extremo izquierdo -->
                                    <li class="page-item <?= $paginaActual <= 1 ? 'disabled' : '' ?>">
                                        <a class="page-link" 
                                        href="?pagina=1&buscar=<?= isset($_GET['buscar']) ? urlencode($_GET['buscar']) : '' ?>&registros=<?= $registrosPorPagina ?>" 
                                        aria-label="First">
                                            <span aria-hidden="true">&laquo;&laquo;</span>
                                        </a>
                                    </li>
                                    
                                    <!-- Botón Anterior -->
                                    <li class="page-item <?= $paginaActual <= 1 ? 'disabled' : '' ?>">
                                        <a class="page-link" 
                                        href="?pagina=<?= $paginaActual-1 ?>&buscar=<?= isset($_GET['buscar']) ? urlencode($_GET['buscar']) : '' ?>&registros=<?= $registrosPorPagina ?>" 
                                        aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    
                                    <!-- Números de página - Centrados -->
                                    <?php 
                                    // Mostrar máximo 5 páginas alrededor de la actual
                                    $inicio = max(1, $paginaActual - 2);
                                    $fin = min($totalPaginas, $paginaActual + 2);
                                    
                                    // Mostrar primera página si no está en el rango
                                    if ($inicio > 1) {
                                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                    }
                                    
                                    // Mostrar páginas en el rango
                                    for ($i = $inicio; $i <= $fin; $i++): ?>
                                        <li class="page-item <?= $paginaActual == $i ? 'active' : '' ?>">
                                            <a class="page-link" 
                                            href="?pagina=<?= $i ?>&buscar=<?= isset($_GET['buscar']) ? urlencode($_GET['buscar']) : '' ?>&registros=<?= $registrosPorPagina ?>">
                                                <?= $i ?>
                                            </a>
                                        </li>
                                    <?php endfor;
                                    
                                    // Mostrar última página si no está en el rango
                                    if ($fin < $totalPaginas) {
                                        echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                                    }
                                    ?>
                                    
                                    <!-- Botón Siguiente -->
                                    <li class="page-item <?= $paginaActual >= $totalPaginas ? 'disabled' : '' ?>">
                                        <a class="page-link" 
                                        href="?pagina=<?= $paginaActual+1 ?>&buscar=<?= isset($_GET['buscar']) ? urlencode($_GET['buscar']) : '' ?>&registros=<?= $registrosPorPagina ?>" 
                                        aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                    
                                    <!-- Botón Última Página - Extremo derecho -->
                                    <li class="page-item <?= $paginaActual >= $totalPaginas ? 'disabled' : '' ?>">
                                        <a class="page-link" 
                                        href="?pagina=<?= $totalPaginas ?>&buscar=<?= isset($_GET['buscar']) ? urlencode($_GET['buscar']) : '' ?>&registros=<?= $registrosPorPagina ?>" 
                                        aria-label="Last">
                                            <span aria-hidden="true">&raquo;&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                            
                            <?php if ($totalPaginas > 1 && $registrosPorPagina > 0): ?>
                                <div class="text-center mt-2">
                                    <span class="text-muted">
                                        Página <?= $paginaActual ?> de <?= $totalPaginas ?>
                                    </span>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal para nuevo contacto -->
    <div class="modal fade" id="nuevoContactoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-user-plus me-2"></i>Nuevo Contacto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="crear.php">
                    <div class="modal-body">
                        <!-- Input del Nombre -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre completo</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required
                                   pattern="[A-Za-záéíóúÁÉÍÓÚñÑ\s]{2,50}" 
                                   title="Solo letras y espacios (2-50 caracteres)">
                        </div>
                        <!-- Input del email -->
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email"
                                   pattern="[^@\s]+@[^@\s]+\.[^@\s]+"
                                   title="Dirección de email válida, por favor (usuario@servidor.com)">
                        </div>
                        <!-- Input del teléfono -->
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" id="telefono" name="telefono" required
                                   pattern="[0-9+()\s-]{6,20}" 
                                   title="Formato de teléfono válido (6-20 caracteres)">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Guardar Contacto</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Cerrar automáticamente las alertas después de 5 segundos
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                new bootstrap.Alert(alert).close();
            });
        }, 5000);
    </script>
</body>
</html>