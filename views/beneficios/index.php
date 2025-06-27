<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$rol = $_SESSION['usuario_rol'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Beneficios</title>
  <link rel="stylesheet" href="/peoplepro/public/css/fondo.css">
  <link rel="stylesheet" href="/peoplepro/public/css/nav.css">
  <link rel="stylesheet" href="/peoplepro/public/css/tablas.css">
</head>
<body>
<?php include __DIR__ . '/../menu/menu.php'; ?><br>
<h2 class="titulo-principal">Beneficios</h2>

<main class="main-tabla">
    <?php if ($rol === 'admin'): ?>
        <a class="btn-tabla" href="/peoplepro/public/index.php?action=beneficio&method=crear">
            <i class="bi bi-gift-fill"></i> Nuevo Beneficio
        </a>
    <?php endif; ?>

    <table class="tablas">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Inicio</th>
                <th>Fin</th>
                <?php if ($rol === 'admin'): ?>
                    <th>Acciones</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($beneficios as $b): ?>
            <tr>
                <td><?= htmlspecialchars($b['nombre']) ?></td>
                <td><?= htmlspecialchars($b['descripcion']) ?></td>
                <td><?= $b['fecha_inicio'] ?></td>
                <td><?= $b['fecha_fin'] ?></td>
                <?php if ($rol === 'admin'): ?>
                <td>
                    <a class="bt-editar" href="/peoplepro/public/index.php?action=beneficio&method=editar&id=<?= $b['id'] ?>"><i class="bi bi-pencil-fill"></i> Editar</a>
                    <a class="bt-eliminar" href="/peoplepro/public/index.php?action=beneficio&method=eliminar&id=<?= $b['id'] ?>" onclick="return confirm('¿Eliminar beneficio?')"><i class="bi bi-trash3-fill"></i> Eliminar</a>
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
