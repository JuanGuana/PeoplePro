<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Asignar Nuevo Horario</title>
  <link rel="stylesheet" href="/peoplepro/public/css/nav.css">
  <link rel="stylesheet" href="/peoplepro/public/css/horario.css">
</head>
<body>
  <!-- Header igual que en otros módulos -->
  <header class="header">
    <div class="izquierda">
      <button class="menu-hamburguesa">
        <span class="linea"></span>
        <span class="linea"></span>
        <span class="linea"></span>
      </button>
      <div id="logo"></div>
    </div>
    <form action="#" class="buscador">
      <input type="text" placeholder="Buscar" class="input-icono">
    </form>
    <div class="derecha">
      <p><?= htmlspecialchars($_SESSION["usuario"] ?? 'Usuario') ?></p>
    </div>
  </header>

  <nav class="nav-desplegable" id="nav-desplegable">
    <ul class="nav-lista">
      <li><a href="/peoplepro/public/home/index">Inicio</a></li>
      <li><a href="/peoplepro/public/usuario/index">Usuarios</a></li>
      <li><a href="/peoplepro/public/permiso/index">Permisos</a></li>
      <li><a href="/peoplepro/public/beneficio/index">Beneficios</a></li>
      <li><a href="/peoplepro/public/visitante/index">Visitantes Externos</a></li>
      <li><a href="/peoplepro/public/documento/index">Documentos</a></li>
      <li><a href="/peoplepro/public/capacitacion/index">Capacitaciones</a></li>
      <li><a href="/peoplepro/public/evaluacion/index">Evaluaciones</a></li>
      <li><a href="/peoplepro/public/area/index">Áreas</a></li>
      <li><a href="/peoplepro/public/asistencia/index">Asistencia</a></li>
      <li><a href="/peoplepro/public/horario/index">Horarios</a></li>
    </ul>
  </nav>

  <main class="main-horario">
    <h2 class="titulo-horario">Asignar Nuevo Horario</h2>

    <form class="formulario-horario" action="/peoplepro/public/horario/crear" method="POST">
      <label>Trabajador:</label>
      <select name="usuario_id" required>
        <option value="">Seleccione...</option>
        <?php foreach ($usuarios as $usuario) : ?>
          <option value="<?= htmlspecialchars($usuario['id']) ?>">
            <?= htmlspecialchars($usuario['nombre']) ?>
          </option>
        <?php endforeach; ?>
      </select>

      <label>Fecha de Inicio:</label>
      <input type="date" name="fecha" required>

      <label>Fecha de Fin:</label>
      <input type="date" name="fecha_fin">

      <label>Hora de Inicio:</label>
      <input type="time" name="hora_inicio" required>

      <label>Hora de Fin:</label>
      <input type="time" name="hora_fin" required>

      <label>Estado:</label>
      <select name="estado" required>
        <option value="Activo">Activo</option>
        <option value="Permiso">Permiso</option>
        <option value="Incapacidad">Incapacidad</option>
        <option value="Inactivo">Inactivo</option>
      </select>

      <label>Observaciones:</label>
      <textarea name="observaciones" rows="3" placeholder="Opcional"></textarea>

      <button type="submit">Guardar</button>
      <a class="btn-volver" href="/peoplepro/public/horario/index">Cancelar</a>
    </form>
  </main>

  <script src="/peoplepro/public/js/nav.js"></script>
</body>
</html>
