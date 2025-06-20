<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Beneficio</title>
  <link rel="stylesheet" href="/peoplepro/public/css/nav.css">
  <link rel="stylesheet" href="/peoplepro/public/css/beneficio.css">
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

  <main class="main-beneficio">
    <h2 class="titulo-beneficio">Editar Beneficio</h2>
    <form class="formulario-beneficio" action="/peoplepro/public/beneficio/actualizar" method="POST">
      <input type="hidden" name="id" value="<?= htmlspecialchars($data['beneficio']['id']) ?>">

      <label>Nombre:</label>
      <input type="text" name="nombre" value="<?= htmlspecialchars($data['beneficio']['nombre']) ?>" required>

      <label>Descripción:</label>
      <textarea name="descripcion" rows="3"><?= htmlspecialchars($data['beneficio']['descripcion']) ?></textarea>

      <label>Fecha de inicio:</label>
      <input type="date" name="fecha_inicio" value="<?= htmlspecialchars($data['beneficio']['fecha_inicio']) ?>">

      <label>Fecha de fin:</label>
      <input type="date" name="fecha_fin" value="<?= htmlspecialchars($data['beneficio']['fecha_fin']) ?>">

      <button type="submit">Actualizar</button>
      <a href="/peoplepro/public/beneficio/index">Cancelar</a>
    </form>
  </main>

  <script src="/peoplepro/public/js/nav.js"></script>
</body>
</html>
