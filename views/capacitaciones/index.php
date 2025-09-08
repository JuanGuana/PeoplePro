<?php $titulo = "Capacitaciones"; ?>
<?php include __DIR__ . '/../layout/header.php'; ?>
  <h2 class="titulo-principal">Capacitaciones</h2>

  <main class="main-tabla"> 
    <?php if ($rol === 'Admin'): ?>
      <a class="btn-tabla" href="/peoplepro/public/index.php?action=capacitacion&method=crear">
        <i class="bi bi-mortarboard-fill"></i> Nueva Capacitación
      </a>
    <?php endif; ?>
    <?php if (!empty($mensaje)): ?>
    <div style="padding:10px; margin:10px 0; border-radius:5px; background:#f8f9fa; border:1px solid #ccc; color:#333;">
        <?= htmlspecialchars($mensaje) ?>
    </div>
<?php endif; ?>


    <table id="myTable" class="table table-striped nowrap responsive">
      <thead>
        <tr>
          <th>Imagen</th>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Fecha</th>
          <?php if ($rol === 'Admin'): ?>
            <th>Acciones</th>
          <?php endif; ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($capacitaciones as $cap): ?>
        <tr>
          <td><img src="<?= htmlspecialchars($cap['imagen_capacitacion']) ?>" style="max-width: 100px;"></td>
          <td><?= htmlspecialchars($cap['nombre']) ?></td>
          <td><?= htmlspecialchars($cap['descripcion']) ?></td>
          <td><?= htmlspecialchars($cap['fecha']) ?></td>
          <?php if ($rol === 'Admin'): ?>
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
<?php include __DIR__ . '/../layout/footer.php'; ?>
