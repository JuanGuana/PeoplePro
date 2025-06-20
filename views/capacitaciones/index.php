<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Capacitaciones</title>
  <link rel="stylesheet" href="/peoplepro/public/css/nav.css">
  <link rel="stylesheet" href="/peoplepro/public/css/capacitacion.css">
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

  <main class="main-capacitacion">
    <h2 class="titulo-capacitacion">Capacitaciones</h2>
    <a href="/peoplepro/public/capacitacion/crear" class="btn-capacitacion">Nueva Capacitación</a>

    <table class="tabla-capacitacion">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Descripción</th>
          <th>Fecha</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach($data['capacitaciones'] as $cap): ?>
        <tr>
          <td><?= htmlspecialchars($cap['nombre']); ?></td>
          <td><?= htmlspecialchars($cap['descripcion']); ?></td>
          <td><?= htmlspecialchars($cap['fecha']); ?></td>
          <td>
            <a class="link-accion editar" href="/peoplepro/public/capacitacion/editar/<?= $cap['id']; ?>">Editar</a> |
            <a class="link-accion eliminar" href="/peoplepro/public/capacitacion/eliminar/<?= $cap['id']; ?>" onclick="return confirm('¿Seguro que quieres eliminar?');">Eliminar</a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>

  <script src="/peoplepro/public/js/nav.js"></script>
</body>
</html>
