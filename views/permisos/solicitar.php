<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Solicitar Permiso</title>
  <link rel="stylesheet" href="/peoplepro/public/css/fondo.css">
</head>
<body>
  <?php include __DIR__ . '/../menu/menu.php'; ?><br>
  <h2 class="titulo-principal">Solicitar Permiso</h2>

  <form action="/peoplepro/public/index.php?action=permiso&method=guardarSolicitud" method="POST" class="formulario">
    <label for="tipo">Tipo de permiso:</label>
    <input type="text" name="tipo" required>
    <br><br>
    <button type="submit">Enviar Solicitud</button>
  </form>
</body>
</html>
