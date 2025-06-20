<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Horarios</title>
  <link rel="stylesheet" href="/peoplepro/public/css/nav.css">
  <link rel="stylesheet" href="/peoplepro/public/css/horario.css">
  <link rel="stylesheet" href="/peoplepro/public/css/fondo.css">
</head>
<body>
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
    <h2 class="titulo-horario">Lista de Horarios</h2>
    <a class="btn-horario" href="/peoplepro/public/horario/crear">➕ Nuevo Horario</a>

    <table border="1" cellpadding="8" cellspacing="0" class="tabla-horario">
      <thead>
        <tr>
          <th>ID</th>
          <th>Trabajador</th>
          <th>Fecha Inicio</th>
          <th>Fecha Fin</th>
          <th>Hora Inicio</th>
          <th>Hora Fin</th>
          <th>Estado</th>
          <th>Observaciones</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($horarios)) : ?>
          <?php foreach ($horarios as $horario): ?>
            <tr>
              <td><?= $horario['id'] ?></td>
              <td><?= htmlspecialchars($horario['usuario_nombre']) ?></td>
              <td><?= $horario['fecha'] ?></td>
              <td><?= $horario['fecha_fin'] ?? '-' ?></td>
              <td><?= $horario['hora_inicio'] ?></td>
              <td><?= $horario['hora_fin'] ?></td>
              <td><?= $horario['estado'] ?></td>
              <td><?= htmlspecialchars($horario['observaciones']) ?></td>
              <td>
                <a href="/peoplepro/public/horario/editar/<?= $horario['id'] ?>">✏️ Editar</a> |
                <a href="/peoplepro/public/horario/eliminar/<?= $horario['id'] ?>" onclick="return confirm('¿Seguro de eliminar este horario?')">🗑️ Eliminar</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else : ?>
          <tr><td colspan="9">No hay horarios registrados.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </main>

  <script src="/peoplepro/public/js/nav.js"></script>
</body>
</html>
