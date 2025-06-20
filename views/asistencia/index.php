<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de Asistencia</title>
    <link rel="stylesheet" href="/peoplepro/public/css/nav.css">
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
        </ul>
    </nav><br>
    <h1>Registro de Asistencia</h1>
    <form action="/peoplepro/public/asistencia/registrarLlegada" method="post">
        <button type="submit">Registrar Llegada</button>
    </form>
    <form action="/peoplepro/public/asistencia/registrarSalida" method="post">
        <button type="submit">Registrar Salida</button>
    </form>

    <h2>Historial</h2>
    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora de Llegada</th>
                <th>Hora de Salida</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($registros) && is_array($registros) && count($registros) > 0): ?>
                <?php foreach ($registros as $registro): ?>
                    <tr>
                        <td><?= htmlspecialchars($registro['fecha']) ?></td>
                        <td><?= htmlspecialchars($registro['hora_llegada']) ?></td>
                        <td><?= htmlspecialchars($registro['hora_salida']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3">No hay registros de asistencia.</td>
                </tr>
            <?php endif; ?>

        </tbody>
    </table>
    <br>
    
    <script src="/peoplepro/public/js/nav.js"></script>
</body>

</html>