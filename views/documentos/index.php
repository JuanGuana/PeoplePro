<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="UTF-8">
    <title>Lista de Documentos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/peoplepro/public/css/nav.css">
</head>

<body class="container mt-5">
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
    <h2>📄 Lista de Documentos</h2>
    <a href="index.php?controller=Documento&action=crear" class="btn btn-primary mb-3">+ Agregar Documento</a>

    <?php if (!empty($documentos)) : ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Archivo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($documentos as $doc) : ?>
                    <tr>
                        <td><?= htmlspecialchars($doc['nombre']) ?></td>
                        <td>
                            <a href="public/uploads/<?= $doc['archivo'] ?>" target="_blank">Ver PDF</a>
                        </td>
                        <td>
                            <a href="index.php?controller=Documento&action=editar&id=<?= $doc['id'] ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="index.php?controller=Documento&action=eliminar&id=<?= $doc['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este documento?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No hay documentos registrados.</p>
    <?php endif ?>
    <script src="/peoplepro/public/js/nav.js"></script>
</body>

</html>