<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Lista de Evaluaciones</title>
  <link rel="stylesheet" href="/peoplepro/public/css/nav.css">
  <link rel="stylesheet" href="/peoplepro/public/css/evaluacion.css">
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

  <main class="main-evaluacion">
    <h1 class="titulo-evaluacion">Lista de Evaluaciones</h1>
    <a href="/peoplepro/public/evaluacion/crear" class="btn-evaluacion">Crear Nueva Evaluación</a>

    <table class="tabla-evaluacion">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Fecha</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($evaluaciones)) : ?>
          <?php foreach ($evaluaciones as $evaluacion) : ?>
            <tr>
              <td><?= htmlspecialchars($evaluacion['id']) ?></td>
              <td><?= htmlspecialchars($evaluacion['nombre']) ?></td>
              <td><?= htmlspecialchars($evaluacion['descripcion']) ?></td>
              <td><?= htmlspecialchars($evaluacion['fecha']) ?></td>
              <td>
                <a class="link-accion editar" href="/peoplepro/public/evaluacion/editar/<?= $evaluacion['id'] ?>">Editar</a> |
                <a class="link-accion eliminar" href="/peoplepro/public/evaluacion/eliminar/<?= $evaluacion['id'] ?>" onclick="return confirm('¿Estás seguro de eliminar esta evaluación?');">Eliminar</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else : ?>
          <tr><td colspan="5">No hay evaluaciones registradas.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </main>

  <script src="/peoplepro/public/js/nav.js"></script>
</body>
</html>
