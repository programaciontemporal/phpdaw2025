<?php
require 'conexion.php';

// Configuración de paginación
$registrosPorPagina = 10;
$pagina = filter_input(INPUT_GET, 'pagina', FILTER_VALIDATE_INT, [
    'options' => ['default' => 1, 'min_range' => 1]
]);

// Parámetros de búsqueda
$busqueda = $_GET['busqueda'] ?? '';
$where = '';
$params = [];

if (!empty($busqueda)) {
    $where = " WHERE nombre LIKE :busqueda OR email LIKE :busqueda";
    $params[':busqueda'] = "%$busqueda%";
}

// Consulta para el total de registros
$queryCount = "SELECT COUNT(*) FROM usuarios" . $where;
$stmtCount = $pdo->prepare($queryCount);
foreach ($params as $key => $value) {
    $stmtCount->bindValue($key, $value);
}
$stmtCount->execute();
$totalRegistros = $stmtCount->fetchColumn();

// Consulta principal con paginación
$offset = ($pagina - 1) * $registrosPorPagina;
$query = "SELECT id_usuario, nombre, email, telefono FROM usuarios" . $where . " ORDER BY nombre LIMIT :offset, :limit";
$stmt = $pdo->prepare($query);

foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':limit', $registrosPorPagina, PDO::PARAM_INT);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Calcular rangos para el mensaje
$inicio = $offset + 1;
$fin = min($offset + $registrosPorPagina, $totalRegistros);
$totalPaginas = ceil($totalRegistros / $registrosPorPagina);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Usuarios</title>
    <!-- Bootstrap Lux Theme -->
    <link rel="stylesheet" href="https://bootswatch.com/5/lux/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Mantenemos los estilos específicos de usuarios */
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 10px;
        }
        
        /* Igualamos estilos de listado.php */
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
            width: 32px;
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
            <a class="navbar-brand" href="#">
                <i class="fas fa-users me-2"></i> Gestión de Usuarios
            </a>
            <div class="navbar-nav ms-auto">
                <a href="#" class="btn btn-sm btn-outline-light">
                    <i class="fas fa-user-plus me-1"></i> Nuevo Usuario
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-md-6">
                <h2 class="display-6"><i class="fas fa-list-ol me-2"></i>Usuarios Registrados</h2>
                <p class="text-muted">Listado completo de usuarios del sistema</p>
            </div>
            <div class="col-md-6">
                <form method="get" class="d-flex">
                    <input type="text" name="busqueda" class="form-control" 
                           placeholder="Buscar por nombre o email..." 
                           value="<?= htmlspecialchars($busqueda) ?>">
                    <input type="hidden" name="pagina" value="1">
                    <button type="submit" class="btn btn-primary ms-2">
                        <i class="fas fa-search"></i>
                    </button>
                    <?php if(!empty($busqueda)): ?>
                        <a href="listado_usuarios.php" class="btn btn-outline-danger ms-2">
                            <i class="fas fa-times"></i>
                        </a>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <?php if(!empty($busqueda)): ?>
            <div class="alert alert-primary mb-4">
                <i class="fas fa-search me-2"></i>
                Resultados para "<strong><?= htmlspecialchars($busqueda) ?></strong>":
                Mostrando <strong><?= $inicio ?>-<?= $fin ?></strong> de <strong><?= $totalRegistros ?></strong> usuarios
            </div>
        <?php endif; ?>

        <!-- Users Table -->
        <div class="card shadow-sm border-0">
            <div class="card-header bg-white border-0 pt-4">
                <h5 class="mb-0"><i class="fas fa-list-ul me-2"></i>Registros</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 50px;"></th>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th class="text-end">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($usuarios as $usuario): ?>
                            <tr>
                                <td>
                                    <div class="user-avatar">
                                        <?= strtoupper(substr($usuario['nombre'], 0, 1)) ?>
                                    </div>
                                </td>
                                <td>
                                    <strong><?= htmlspecialchars($usuario['nombre']) ?></strong>
                                </td>
                                <td><?= htmlspecialchars($usuario['email']) ?></td>
                                <td><?= $usuario['telefono'] ? htmlspecialchars($usuario['telefono']) : '<span class="text-muted">N/A</span>' ?></td>
                                <td class="text-end">
                                    <div class="btn-group btn-group-sm">
                                        <button class="btn btn-outline-primary action-btn" title="Ver">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-secondary action-btn" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-outline-danger action-btn" title="Eliminar">
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

    <!-- Footer -->
    <footer class="bg-light py-4 mt-5">
        <div class="container text-center">
            <p class="mb-0 text-muted">
                <i class="fas fa-user-shield me-1"></i> Sistema de Gestión de Usuarios
            </p>
            <small class="text-muted">© <?= date('Y') ?> Todos los derechos reservados</small>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>