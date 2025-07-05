<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Permiso</title>
  <link rel="stylesheet" href="/peoplepro/public/css/formularios.css">
  <!-- icono de la pestaña -->
    <link rel="shortcut icon" href="/peoplepro/public/img/logo.png"/>
</head>
<body>
  <h2>Editar Permiso</h2>
  <form action="/peoplepro/public/index.php?action=permiso&method=actualizar&id=<?= $data['permiso']['id'] ?>" method="POST">
    <label for="tipo">Tipo de permiso:</label>
    <input type="text" name="tipo" id="tipo" value="<?= htmlspecialchars(trim($data['permiso']['tipo'])) ?>" required>

    <label for="usuario_id">Trabajador:</label>
    <select name="usuario_id" id="usuario_id" required>
      <option value="">Seleccione un trabajador</option>
      <?php foreach ($data['usuarios'] as $usuario): ?>
        <option value="<?= $usuario['id'] ?>" <?= $usuario['id'] == $data['permiso']['usuario_id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($usuario['nombre']) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <br><br>
    <button type="submit">Actualizar</button>
    <a href="/peoplepro/public/index.php?action=permiso&method=index">Cancelar</a>
  </form>
</body>
</html>
