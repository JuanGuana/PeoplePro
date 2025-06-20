<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Visitantes Externos</title>
  <link rel="stylesheet" href="/peoplepro/public/css/nav.css">
  <link rel="stylesheet" href="/peoplepro/public/css/visitante.css">
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

  <main class="main-visitante">
    <h2 class="titulo-visitante">Gestión de Visitantes Externos</h2>
    <a class="btn-nuevo" href="/peoplepro/public/visitante/crear">➕ Registrar Visitante</a>

    <table id="visitanteTable" border="1" cellpadding="10" cellspacing="0">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Documento</th>
          <th>Empresa</th>
          <th>Fecha Ingreso</th>
          <th>Motivo</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($data['visitantes'])): ?>
          <?php foreach ($data['visitantes'] as $visitante): ?>
            <tr>
              <td><?= htmlspecialchars($visitante['id']) ?></td>
              <td><?= htmlspecialchars($visitante['nombre']) ?></td>
              <td><?= htmlspecialchars($visitante['documento']) ?></td>
              <td><?= htmlspecialchars($visitante['empresa']) ?></td>
              <td><?= htmlspecialchars($visitante['fecha_ingreso']) ?></td>
              <td><?= htmlspecialchars($visitante['motivo']) ?></td>
              <td>
                <a href="/peoplepro/public/visitante/editar/<?= $visitante['id'] ?>">✏️ Editar</a> |
                <a href="/peoplepro/public/visitante/eliminar/<?= $visitante['id'] ?>" onclick="return confirm('¿Estás seguro de eliminar este visitante?')">🗑️ Eliminar</a>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr>
            <td colspan="7">No hay visitantes registrados.</td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </main>

  <script src="/peoplepro/public/js/nav.js"></script>
</body>

</html>