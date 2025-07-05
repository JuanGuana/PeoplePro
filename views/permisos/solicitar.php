<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Solicitar Permiso</title>
  <link rel="stylesheet" href="/peoplepro/public/css/fondo.css">
  <link rel="stylesheet" href="/peoplepro/public/css/formularios.css">
    <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <!-- botstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
  <!-- icono de la pestaña -->
    <link rel="shortcut icon" href="/peoplepro/public/img/logo.png"/>
</head>
<body>
  <h2 class="titulo-principal">Solicitar Permiso</h2>

  <form action="/peoplepro/public/index.php?action=permiso&method=guardarSolicitud" method="POST" class="formulario">
    <label for="tipo">Tipo de permiso:</label>
    <select name="tipo" id="select-permiso" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
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
    <label for="fecha_inicio">Fecha de inicio:</label>
    <input type="date" name="fecha_inicio" id="fecha_inicio" required>
    <br><br>

    <label for="fecha_fin">Fecha de fin:</label>
    <input type="date" name="fecha_fin" id="fecha_fin" required>
    <br><br>

    <a href="/peoplepro/public/index.php?action=permiso" class="btn-volver">Cancelar</a>
    <button type="submit">Enviar Solicitud</button>
  </form>
  <script src="/peoplepro/public/js/nav.js"></script>
</body>
</html>
