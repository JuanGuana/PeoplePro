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
  <!-- icono de la pestaña -->
  <link rel="shortcut icon" href="/peoplepro/public/img/logo.png"/>
</head>
<body>
  <?php include __DIR__ . '/../menu/menu.php'; ?><br>
  <!-- titulo principal -->
  <h2 class="titulo-principal">Gestión de Permisos</h2>

  <main class="main-tabla">
    <!-- boton para solicitar permiso -->
    <?php if ($rol === 'usuario'): ?>
      <a class="btn-tabla" href="/peoplepro/public/index.php?action=permiso&method=solicitud">
        <i class="bi bi-envelope-plus"></i> Solicitar Permiso
      </a>
    <?php endif; ?>
    <!-- tabla de permisos -->
    <table class="tablas">
      <thead>
        <tr>
          <th>ID</th>
          <th>Trabajador</th>
          <th>Tipo</th>
          <th>Fecha de Inicio</th>
          <th>Fecha de Fin</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
          <?php if (!empty($permisos)) : ?>
            <?php foreach ($permisos as $permiso): ?>
              <?php
                $esPropietario = ($permiso['usuario_id'] ?? null) == ($_SESSION['usuario_id'] ?? null);
                $estado = strtolower($permiso['estado']);
              ?>
              <tr>
                <td><?= htmlspecialchars($permiso['id']) ?></td>
                <td><?= htmlspecialchars($permiso['usuario'] ?? 'Sin asignar') ?></td>
                <td><?= htmlspecialchars(trim($permiso['tipo'])) ?></td>
                <td><?= htmlspecialchars($permiso['fecha_inicio']) ?></td>
                <td><?= htmlspecialchars($permiso['fecha_fin']) ?></td>
                <td>
                  <?php
                    $estado = strtolower(trim($permiso['estado']));
                    $clase = "estado estado-" . $estado;
                  ?>
                  <span class="<?= $clase ?>"><?= htmlspecialchars($permiso['estado']) ?></span>
                </td>
                <td>
                  <?php if ($rol === 'admin'): ?>
                    <a href="/peoplepro/public/index.php?action=permiso&method=actualizarEstado&id=<?= $permiso['id'] ?>&estado=Aprobado" class="bt-editar">
                      <i class="bi bi-check-circle-fill"></i> Aprobar
                    </a>
                    <a href="/peoplepro/public/index.php?action=permiso&method=actualizarEstado&id=<?= $permiso['id'] ?>&estado=Rechazado" class="bt-rechazar">
                      <i class="bi bi-x-circle-fill"></i> Rechazar
                    </a>
                    <a href="/peoplepro/public/index.php?action=permiso&method=eliminar&id=<?= $permiso['id'] ?>" class="bt-eliminar" onclick="return confirm('¿Eliminar este permiso?')">
                      <i class="bi bi-trash3-fill"></i> Eliminar
                    </a>
                  <?php elseif ($rol === 'usuario' && $esPropietario && $estado === 'pendiente'): ?>
                    <a href="/peoplepro/public/index.php?action=permiso&method=eliminar&id=<?= $permiso['id'] ?>" class="bt-eliminar" onclick="return confirm('¿Eliminar este permiso?')">
                      <i class="bi bi-trash3-fill"></i> Eliminar
                    </a>
                  <?php endif; ?>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr><td colspan="<?= $rol === 'admin' ? 6 : 6 ?>">No hay permisos registrados.</td></tr>
          <?php endif; ?>
        </tbody>

    </table>
  </main>
  <script src="/peoplepro/public/js/nav.js"></script>
</body>
</html>
