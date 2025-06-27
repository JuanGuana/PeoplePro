<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$rol = $_SESSION['usuario_rol'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Áreas de trabajo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/peoplepro/public/css/fondo.css">
    <link rel="stylesheet" href="/peoplepro/public/css/nav.css">
    <link rel="stylesheet" href="/peoplepro/public/css/tablas.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
<?php include __DIR__ . '/../menu/menu.php'; ?><br>

<h2 class="titulo-principal">Gestión de Áreas</h2>

<main class="main-tabla">

    <?php if ($rol === 'admin'): ?>
        <a class="btn-tabla" href="/peoplepro/public/index.php?action=area&method=crear" title="Crear nueva área">
            <i class="bi bi-bookmark-plus-fill"></i> Nueva Área
        </a>
    <?php endif; ?>

    <table class="tablas">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <?php if ($rol === 'admin'): ?>
                    <th>Acciones</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['areas'] as $area): ?>
            <tr>
                <td><?= htmlspecialchars($area['id']) ?></td>
                <td><?= htmlspecialchars($area['nombre']) ?></td>
                <td><?= htmlspecialchars($area['descripcion']) ?></td>
                <?php if ($rol === 'admin'): ?>
                    <td>
                        <a class="bt-editar" href="/peoplepro/public/index.php?action=area&method=editar&id=<?= $area['id'] ?>">
                            <i class="bi bi-pencil-fill"></i> Editar
                        </a>
                        <a class="bt-eliminar" href="/peoplepro/public/index.php?action=area&method=eliminar&id=<?= $area['id'] ?>" onclick="return confirm('¿Eliminar esta área?')">
                            <i class="bi bi-trash3-fill"></i> Eliminar
                        </a>
                    </td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<script src="/peoplepro/public/js/nav.js"></script>
</body>
</html>
