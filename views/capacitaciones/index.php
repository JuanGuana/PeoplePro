<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$rol = $_SESSION['usuario_rol'] ?? '';
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Capacitaciones</title>
  <link rel="stylesheet" href="/peoplepro/public/css/fondo.css">
  <link rel="stylesheet" href="/peoplepro/public/css/nav.css">
  <link rel="stylesheet" href="/peoplepro/public/css/tablas.css">
  <!-- botstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
  <!-- icono de la pestaña -->
  <link rel="shortcut icon" href="/peoplepro/public/img/logo.png"/>
</head>
<body>
  <?php include __DIR__ . '/../menu/menu.php'; ?><br>
  <h2 class="titulo-principal">Capacitaciones</h2>

  <main class="main-tabla"> 
    <?php if ($rol === 'admin'): ?>
      <a class="btn-tabla" href="/peoplepro/public/index.php?action=capacitacion&method=crear">
        <i class="bi bi-mortarboard-fill"></i> Nueva Capacitación
      </a>
    <?php endif; ?>

    <table class="tablas">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Fecha</th>
          <?php if ($rol === 'admin'): ?>
            <th>Acciones</th>
          <?php endif; ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($capacitaciones as $cap): ?>
        <tr>
          <td><?= htmlspecialchars($cap['nombre']) ?></td>
          <td><?= htmlspecialchars($cap['descripcion']) ?></td>
          <td><?= htmlspecialchars($cap['fecha']) ?></td>
          <?php if ($rol === 'admin'): ?>
          <td>
            <a class="bt-editar" href="/peoplepro/public/index.php?action=capacitacion&method=editar&id=<?= $cap['id'] ?>">
              <i class="bi bi-pencil-fill"></i> Editar
            </a>
            <a class="bt-eliminar" href="/peoplepro/public/index.php?action=capacitacion&method=eliminar&id=<?= $cap['id'] ?>" onclick="return confirm('¿Seguro que quieres eliminar esta capacitación?');">
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
