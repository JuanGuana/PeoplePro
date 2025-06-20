<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Beneficio</title>
  <link rel="stylesheet" href="/peoplepro/public/css/nav.css">
  <link rel="stylesheet" href="/peoplepro/public/css/beneficio.css">
</head>
<body>
  <header class="header">
    <div class="izquierda">
      <button class="menu-hamburguesa">
        <span class="linea"></span><span class="linea"></span><span class="linea"></span>
      </button>
      <div id="logo"></div>
    </div>
    <form class="buscador">
      <input type="text" placeholder="Buscar" class="input-icono">
    </form>
    <div class="derecha">
      <p><?= htmlspecialchars($_SESSION["usuario"] ?? 'Usuario') ?></p>
    </div>
  </header>

  <nav class="nav-desplegable" id="nav-desplegable">
    <!-- misma lista de enlaces -->
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
    <h2 class="titulo-beneficio">Registrar Beneficio</h2>
    <form class="formulario-beneficio" action="/peoplepro/public/beneficio/guardar" method="POST">
      <label>Nombre:</label>
      <input type="text" name="nombre" required>

      <label>Descripción:</label>
      <textarea name="descripcion" rows="3"></textarea>

      <label>Fecha de inicio:</label>
      <input type="date" name="fecha_inicio">

      <label>Fecha de fin:</label>
      <input type="date" name="fecha_fin">

      <button type="submit">Guardar</button>
      <a href="/peoplepro/public/beneficio/index">Cancelar</a>
    </form>
  </main>

  <script src="/peoplepro/public/js/nav.js"></script>
</body>
</html>
