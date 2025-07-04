<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Horario</title>
  <link rel="stylesheet" href="/peoplepro/public/css/fondo.css">
  <link rel="stylesheet" href="/peoplepro/public/css/formularios.css">
    <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <!-- botstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">

</head>
<body>
  <main class="main-horario">
    <h2 class="titulo-horario">Editar Horario</h2>

    <form class="formulario-horario" action="/peoplepro/public/index.php?action=horario&method=editar&id=<?= htmlspecialchars($horario['id']) ?>" method="POST">
      <label for="usuario_id">Trabajador:</label>
      <select name="usuario_id" id="usuario_id" required class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
        <?php foreach ($usuarios as $usuario) : ?>
          <option value="<?= $usuario['id'] ?>" <?= ($usuario['id'] == $horario['usuario_id']) ? 'selected' : '' ?>>
            <?= htmlspecialchars($usuario['nombre']) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <label for="fecha">Fecha de Inicio:</label>
      <input type="date" name="fecha" id="fecha" value="<?= htmlspecialchars($horario['fecha']) ?>" required>

      <label for="fecha_fin">Fecha de Fin:</label>
      <input type="date" name="fecha_fin" id="fecha_fin" value="<?= htmlspecialchars($horario['fecha_fin']) ?>">

      <label for="hora_inicio">Hora de Inicio:</label>
      <input type="time" name="hora_inicio" id="hora_inicio" value="<?= htmlspecialchars($horario['hora_inicio']) ?>" required>

      <label for="hora_fin">Hora de Fin:</label>
      <input type="time" name="hora_fin" id="hora_fin" value="<?= htmlspecialchars($horario['hora_fin']) ?>" required>

      <label for="estado">Estado:</label>
      <select name="estado" id="estado" required class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
        <?php foreach (['Activo', 'Permiso', 'Incapacidad', 'Inactivo'] as $estado) : ?>
          <option value="<?= $estado ?>" <?= ($horario['estado'] === $estado) ? 'selected' : '' ?>>
            <?= $estado ?>
          </option>
        <?php endforeach; ?>
      </select>

      <label for="observaciones">Observaciones:</label>
      <textarea name="observaciones" id="observaciones" rows="3"><?= htmlspecialchars($horario['observaciones']) ?></textarea>

      <a class="btn-volver" href="/peoplepro/public/index.php?action=horario" class="btn-volver">Cancelar</a>
      <button type="submit">Actualizar</button>
    </form>
  </main>
  <script src="/peoplepro/public/js/nav.js"></script>
</body>
</html>