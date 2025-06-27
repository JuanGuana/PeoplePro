<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Permiso</title>
  <link rel="stylesheet" href="/peoplepro/public/css/formularios.css">
</head>
<body>
  <h2>Crear Nuevo Permiso</h2>
  <form action="/peoplepro/public/index.php?action=permiso&method=guardar" method="POST">
    <label for="tipo">Tipo de permiso:</label>
    <input type="text" name="tipo" id="tipo" required>

    <label for="usuario_id">Trabajador:</label>
    <select name="usuario_id" id="usuario_id" required>
      <option value="">Seleccione un trabajador</option>
      <?php foreach ($data['usuarios'] as $usuario): ?>
        <option value="<?= $usuario['id'] ?>"><?= htmlspecialchars($usuario['nombre']) ?></option>
      <?php endforeach; ?>
    </select>

    <br><br>
    <button type="submit">Guardar</button>
    <a href="/peoplepro/public/index.php?action=permiso&method=index">Cancelar</a>
  </form>
</body>
</html>
