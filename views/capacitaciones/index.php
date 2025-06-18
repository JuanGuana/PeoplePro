<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capacitaciones</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.3/css/buttons.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.3/css/buttons.bootstrap5.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/peoplepro/public/css/nav.css">
    <link rel="stylesheet" href="/peoplepro/public/css/usuario.css">
    <link rel="stylesheet" href="/peoplepro/public/css/datatable.css">

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
        <input type="text" placeholder="Buscar..." class="input-buscador">
        <button type="submit" class="buscador-icono"><i class="bi bi-search"></i></button>
        </form>
        <div class="derecha">
            <p><?= htmlspecialchars($_SESSION["usuario"] ?? 'Usuario') ?></p>
            <button class="bi-button" id="boton-configuracion"><i class="bi bi-gear"></i></button>
        </div>
        <nav class="nav-seccion">
            <li>
                <select id="tema-select">
                    <option value="claro">Claro</option>
                    <option value="oscuro">Oscuro</option>
                </select>
            </li>
            <li><a href="#">Cerrar sesión</a></li>
        </nav>
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
        </ul>
    </nav><br>
    <h2>Capacitaciones</h2>
    <a href="/peoplepro/public/capacitacion/crear">Nueva Capacitación</a>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
        <?php foreach($data['capacitaciones'] as $cap): ?>
            <tr>
                <td><?php echo htmlspecialchars($cap['nombre']); ?></td>
                <td><?php echo htmlspecialchars($cap['descripcion']); ?></td>
                <td><?php echo htmlspecialchars($cap['fecha']); ?></td>
                <td>
                    <a href="/peoplepro/public/capacitacion/editar/<?php echo $cap['id']; ?>">Editar</a> |
                    <a href="/peoplepro/public/capacitacion/eliminar/<?php echo $cap['id']; ?>" onclick="return confirm('¿Seguro que quieres eliminar?');">Eliminar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table><br>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>

    <!-- DataTables y Extensiones -->
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.4/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.4/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.bootstrap5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap JS (uno solo es suficiente) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Tu código JS -->
    <script src="/peoplepro/public/js/datatable.js"></script>
    <script src="/peoplepro/public/js/nav.js"></script>
    <script src="/peoplepro/public/js/darkMode.js"></script>
</body>
</html>
