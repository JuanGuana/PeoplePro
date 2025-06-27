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
    <a class="btn-tabla" href="/peoplepro/public/index.php?action=permiso&method=crear">
      <i class="bi bi-luggage-fill"></i> Nuevo Permiso
    </a>
    <table class="tablas">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tipo</th>
          <th>Trabajador</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($permisos as $permiso): ?>
        <tr>
          <td><?= htmlspecialchars($permiso['id']) ?></td>
          <td><?= htmlspecialchars(trim($permiso['tipo'])) ?></td>
          <td><?= htmlspecialchars($permiso['usuario'] ?? 'Sin asignar') ?></td>
          <td>
            <a class="bt-editar" href="/peoplepro/public/index.php?action=permiso&method=editar&id=<?= $permiso['id'] ?>">
              <i class="bi bi-pencil-fill"></i> Editar
            </a>
            <a class="bt-eliminar" href="/peoplepro/public/index.php?action=permiso&method=eliminar&id=<?= $permiso['id'] ?>" onclick="return confirm('¿Estás seguro de eliminar este permiso?')">
              <i class="bi bi-trash3-fill"></i> Eliminar
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>
  <script src="/peoplepro/public/js/nav.js"></script>
</body>
</html>
