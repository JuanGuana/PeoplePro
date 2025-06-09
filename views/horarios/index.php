<h2>Lista de Horarios Asignados</h2>
<a href="index.php?c=horarios&a=crear">Nuevo Horario</a>
<table border="1" cellpadding="6" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Trabajador</th>
        <th>Fecha</th>
        <th>Entrada</th>
        <th>Salida</th>
        <th>Estado</th>
        <th>Observaciones</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($horarios as $h): ?>
        <tr>
            <td><?= $h['id'] ?></td>
            <td><?= $h['nombre'] ?></td>
            <td><?= $h['fecha'] ?></td>
            <td><?= $h['hora_entrada'] ?></td>
            <td><?= $h['hora_salida'] ?></td>
            <td><?= $h['estado'] ?></td>
            <td><?= $h['observaciones'] ?></td>
            <td>
                <a href="index.php?c=horarios&a=editar&id=<?= $h['id'] ?>">Editar</a> |
                <a href="index.php?c=horarios&a=eliminar&id=<?= $h['id'] ?>" onclick="return confirm('¿Eliminar este horario?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
