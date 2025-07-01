<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$rol = $_SESSION['usuario_rol'] ?? '';
$usuario_id = $_SESSION['usuario_id'] ?? null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Gestión de Permisos</title>
  <link rel="stylesheet" href="/peoplepro/public/css/fondo.css">
  <link rel="stylesheet" href="/peoplepro/public/css/nav.css">
  <link rel="stylesheet" href="/peoplepro/public/css/tablas.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body>
  <?php include __DIR__ . '/../menu/menu.php'; ?><br>

  <h2 class="titulo-principal">Gestión de Permisos</h2>

  <main class="main-tabla">

    <?php if ($rol === 'usuario'): ?>
      <a class="btn-tabla" href="/peoplepro/public/index.php?action=permiso&method=solicitud">
        <i class="bi bi-envelope-plus"></i> Solicitar Permiso
      </a>
    <?php endif; ?>

    <table class="tablas">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tipo</th>
          <th>Trabajador</th>
          <th>Estado</th>
          <?php if ($rol === 'admin'): ?>
            <th>Acciones</th>
          <?php endif; ?>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($permisos)) : ?>
          <?php foreach ($permisos as $permiso): ?>
            <tr>
              <td><?= htmlspecialchars($permiso['id']) ?></td>
              <td><?= htmlspecialchars(trim($permiso['tipo'])) ?></td>
              <td><?= htmlspecialchars($permiso['usuario'] ?? 'Sin asignar') ?></td>
              <td>
                <?php if ($permiso['estado'] === 'Pendiente'): ?>
                  <span style="color: orange;"><strong>Pendiente</strong></span>
                <?php elseif ($permiso['estado'] === 'Aprobado'): ?>
                  <span style="color: green;"><strong>Aprobado</strong></span>
                <?php elseif ($permiso['estado'] === 'Rechazado'): ?>
                  <span style="color: red;"><strong>Rechazado</strong></span>
                <?php else: ?>
                  <?= htmlspecialchars($permiso['estado']) ?>
                <?php endif; ?>
              </td>

              <?php if ($rol === 'admin'): ?>
              <td>
                <a href="/peoplepro/public/index.php?action=permiso&method=actualizarEstado&id=<?= $permiso['id'] ?>&estado=Aprobado" class="bt-editar">
                  <i class="bi bi-check-circle-fill"></i> Aprobar
                </a>
                <a href="/peoplepro/public/index.php?action=permiso&method=actualizarEstado&id=<?= $permiso['id'] ?>&estado=Rechazado" class="bt-rechazar">
                  <i class="bi bi-x-circle-fill"></i> Rechazar
                </a>
                <a href="/peoplepro/public/index.php?action=permiso&method=eliminar&id=<?= $permiso['id'] ?>" class="bt-eliminar" onclick="return confirm('¿Eliminar este permiso?')">
                  <i class="bi bi-trash3-fill"></i> Eliminar
                </a>
              </td>
              <?php endif; ?>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="<?= $rol === 'admin' ? 5 : 4 ?>">No hay permisos registrados.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </main>

  <script src="/peoplepro/public/js/nav.js"></script>
</body>
</html>
