<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Áreas de trabajo</title>
    <link rel="stylesheet" href="/peoplepro/public/css/nav.css">
    <link rel="stylesheet" href="/peoplepro/public/css/areas.css">
    <link rel="stylesheet" href="/peoplepro/public/css/fondo.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
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
    </nav><br>
    <h2 class="area-titulo">Gestión de Áreas</h2>
    <div class="nueva-area-contenedor"><button class="nueva-area" title="crear nueva área">+</button></div>
    <main class="main">
        <?php foreach ($data['areas'] as $area): ?>
        <div class="area-contenedor">   
            <div class="area">
                <div class="area-header">
                    <h2 style="color: <?= htmlspecialchars($area['color_fondo']) ?>;"><?= $area['nombre'] ?></h2>
                    <button class="confuguracion-area" id="configuracion-<?= $area['id'] ?>"><img src="/peoplepro/public/img/dots_three_outline_vertical_icon_173863.svg" alt="Config"></button>
                </div>
                <p><?= $area['descripcion'] ?></p>
                <button class="ver-mas" onclick="window.location.href='#'"><a href="">ver más</a></button>
            </div>
            <ul class="area-menu" id="area-menu-<?= $area['id'] ?>">
                <h2>Configuración</h2>
                <li class="abrir-iframe" data-src="/peoplepro/public/area/editar/<?= $area['id'] ?>" style="cursor: pointer;">✏️ Editar</li>
                <li><a href="/peoplepro/public/area/eliminar/<?= $area['id'] ?>" onclick="return confirm('¿Eliminar esta área?')">❌ Eliminar</a></li>
            </ul>
            <div class="color-fondo" style="background-color: <?= htmlspecialchars($area['color_fondo']) ?>;"></div>
        </div>
        <?php endforeach; ?>
        <div id="pantalla-oscura">
            <div id="iframe-contenedor">
                <iframe id="iframe-editar" data-src="/peoplepro/public/area/editar/<?= $area['id'] ?>" width="100%" height="100%" frameborder="0"></iframe>
            </div>
        </div>
    </main>
    <script src="/peoplepro/public/js/iframesAreas.js"></script>
    <script src="/peoplepro/public/js/nav.js"></script>
    <script src="/peoplepro/public/js/areas.js"></script>
</body>
</html>
