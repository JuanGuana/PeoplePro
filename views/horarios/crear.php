<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Asignar Nuevo Horario</title>
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
    <main class="main-horario"> 
    <h2 class="titulo-horario">Asignar Nuevo Horario</h2>
    
    <form class="formulario-horario" action="/peoplepro/public/index.php?action=horario&method=crear" method="POST">
        
        <label for="usuario_id">Trabajador:</label>
        <select name="usuario_id" id="usuario_id" required>
            <option value="" disabled selected>Seleccione un trabajador</option>
            <?php if (!empty($usuarios)): ?>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?= htmlspecialchars($usuario['id']) ?>">
                        <?= htmlspecialchars($usuario['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            <?php else: ?>
                <option disabled>No hay usuarios disponibles</option>
            <?php endif; ?>
        </select>

        <label for="fecha">Fecha de Inicio:</label>
        <input type="date" name="fecha" id="fecha" required>

        <label for="fecha_fin">Fecha de Fin:</label>
        <input type="date" name="fecha_fin" id="fecha_fin">

        <label for="hora_inicio">Hora de Inicio:</label>
        <input type="time" name="hora_inicio" id="hora_inicio" required>

        <label for="hora_fin">Hora de Fin:</label>
        <input type="time" name="hora_fin" id="hora_fin" required>

        <label for="estado">Estado:</label>
        <select name="estado" id="estado" required>
            <option value="Activo">Activo</option>
            <option value="Permiso">Permiso</option>
            <option value="Incapacidad">Incapacidad</option>
            <option value="Inactivo">Inactivo</option>
        </select>

        <label for="observaciones">Observaciones:</label>
        <textarea name="observaciones" id="observaciones" rows="3" placeholder="Opcional"></textarea>

        <a class="btn-volver" href="/peoplepro/public/index.php?action=horario&method=index">Cancelar</a>
        <button type="submit">Guardar</button>
    </form>
</main>


  <script src="/peoplepro/public/js/nav.js"></script>
</body>
</html>