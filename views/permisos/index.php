<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Gestión de Permisos</title>
  <link rel="stylesheet" href="/peoplepro/public/css/nav.css">
  <link rel="stylesheet" href="/peoplepro/public/css/permiso.css">
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

  <main class="main-permiso">
    <h2 class="titulo-permiso">Gestión de Permisos</h2>
    <a href="/peoplepro/public/permiso/crear" class="btn-permiso">➕ Nuevo Permiso</a>

    <table class="tabla-permiso">
      <thead>
        <tr>
          <th>ID</th>
          <th>Tipo</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data['permisos'] as $permiso): ?>
          <tr>
            <td><?= $permiso['id'] ?></td>
            <td><?= $permiso['tipo'] ?></td>
            <td>
              <a href="/peoplepro/public/permiso/editar/<?= $permiso['id'] ?>" class="link-accion editar">✏️ Editar</a> |
              <a href="/peoplepro/public/permiso/eliminar/<?= $permiso['id'] ?>" onclick="return confirm('¿Estás seguro de eliminar este permiso?')" class="link-accion eliminar">🗑️ Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </main>

  <script src="/peoplepro/public/js/nav.js"></script>
</body>

</html>