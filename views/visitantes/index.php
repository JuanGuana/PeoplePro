<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Visitantes Externos</title>
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
    <h2>Lista de Visitantes Externos</h2>
    <a href="/peoplepro/public/visitante/crear">Registrar nuevo visitante</a>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Documento</th>
            <th>Empresa</th>
            <th>Fecha Ingreso</th>
            <th>Motivo</th>
            <th>Acciones</th>
        </tr>
        <?php foreach($data['visitantes'] as $v): ?>
            <tr>
                <td><?= $v['id'] ?></td>
                <td><?= $v['nombre'] ?></td>
                <td><?= $v['documento'] ?></td>
                <td><?= $v['empresa'] ?></td>
                <td><?= $v['fecha_ingreso'] ?></td>
                <td><?= $v['motivo'] ?></td>
                <td>
                    <a href="/peoplepro/public/visitante/editar/<?= $v['id'] ?>">Editar</a> |
                    <a href="/peoplepro/public/visitante/eliminar/<?= $v['id'] ?>" onclick="return confirm('¿Estás seguro de eliminar?')">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table><br>
    <script src="/peoplepro/public/js/nav.js"></script>
</body>
</html>
