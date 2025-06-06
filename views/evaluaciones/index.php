<h2>Listado de Evaluaciones</h2>

<a href="/peoplepro/public/menu.php">
    <button>Volver al Inicio</button>
</a>

<a href="/peoplepro/public/evaluacion/crear">
    <button>Crear nueva evaluación</button>
</a>

<table border="1" style="margin-top: 10px;">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Fecha</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($data['evaluaciones'] as $eval): ?>
    <tr>
        <td><?= $eval['id'] ?></td>
        <td><?= $eval['nombre'] ?></td>
        <td><?= $eval['descripcion'] ?></td>
        <td><?= $eval['fecha'] ?></td>
        <td>
            <a href="/peoplepro/public/evaluacion/editar/<?= $eval['id'] ?>">Editar</a> |
            <a href="/peoplepro/public/evaluacion/eliminar/<?= $eval['id'] ?>" onclick="return confirm('¿Seguro que deseas eliminar esta evaluación?')">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
    
