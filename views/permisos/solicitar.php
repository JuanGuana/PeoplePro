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
    <select name="tipo" id="select-permiso">
      <option value="Permiso por enfermedad">Permiso por enfermedad</option>
      <option value="Permiso por maternidad/paternidad">Permiso por maternidad/paternidad</option>
      <option value="Permiso por matrimonio">Permiso por matrimonio</option>
      <option value="Permiso por calamidad doméstica">Permiso por calamidad doméstica</option>
      <option value="Permiso por luto">Permiso por luto</option>
      <option value="Permiso para citas médicas">Permiso para citas médicas</option>
      <option value="Permiso para votar">Permiso para votar</option>
      <option value="Permiso para cumplir con deberes públicos">Permiso para cumplir con deberes públicos</option>
      <option value="Permiso para funciones sindicales">Permiso para funciones sindicales</option>
      <option value="Permiso por mudanza">Permiso por mudanza</option>
      <option value="Permiso por vacaciones">Permiso por vacaciones</option>
    </select>
    <br><br>
    <button type="submit">Enviar Solicitud</button>
  </form>
  <script src="/peoplepro/public/js/nav.js"></script>
</body>
</html>
