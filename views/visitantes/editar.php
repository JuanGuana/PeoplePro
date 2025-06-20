<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Editar Visitante</title>
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
    <h2 class="titulo-visitante">Editar Visitante</h2>
    <form class="formulario-visitante" action="/peoplepro/public/visitante/actualizar" method="POST">
      <input type="hidden" name="id" value="<?= $data['visitante']['id'] ?>">

      <label>Nombre:</label>
      <input type="text" name="nombre" value="<?= htmlspecialchars($data['visitante']['nombre']) ?>" required>

      <label>Documento:</label>
      <input type="text" name="documento" value="<?= htmlspecialchars($data['visitante']['documento']) ?>" required>

      <label>Empresa:</label>
      <input type="text" name="empresa" value="<?= htmlspecialchars($data['visitante']['empresa']) ?>">

      <label>Fecha y hora de ingreso:</label>
      <input type="datetime-local" name="fecha_ingreso" value="<?= date('Y-m-d\TH:i', strtotime($data['visitante']['fecha_ingreso'])) ?>" required>

      <label>Motivo:</label>
      <textarea name="motivo" rows="3"><?= htmlspecialchars($data['visitante']['motivo']) ?></textarea>

      <button type="submit">Actualizar</button>
      <a href="/peoplepro/public/visitante/index">Cancelar</a>
    </form>
  </main>

  <script src="/peoplepro/public/js/nav.js"></script>
</body>

</html>