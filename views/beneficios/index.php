<?php $titulo = "Beneficios"; ?>
<?php include __DIR__ . '/../layout/header.php'; ?>
    <h2 class="titulo-principal">Beneficios</h2>

    <main class="main-tabla">
        <?php if ($rol === 'admin'): ?>
            <a class="btn-tabla" href="/peoplepro/public/index.php?action=beneficio&method=crear">
                <i class="bi bi-gift-fill"></i> Nuevo Beneficio
            </a>
        <?php endif; ?>

        <table id="myTable" class="table table-striped nowrap responsive">
            <thead>
                <tr>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                    <?php if ($rol === 'admin'): ?>
                        <th>Acciones</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($beneficios as $b): ?>
                <tr>
                    <td> <?php if (!empty($b['imagen'])): ?>
                        <img src="/peoplepro/<?= htmlspecialchars($b['imagen']) ?>" style="max-width: 100px;">
                    <?php else: ?>
                        <span>Sin imagen</span>
                    <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($b['nombre']) ?></td>
                    <td><?= htmlspecialchars($b['descripcion']) ?></td>
                    <td><?= $b['fecha_inicio'] ?></td>
                    <td><?= $b['fecha_fin'] ?></td>
                    <?php if ($rol === 'admin'): ?>
                    <td>
                        <a class="bt-editar" href="/peoplepro/public/index.php?action=beneficio&method=editar&id=<?= $b['id'] ?>"><i class="bi bi-pencil-fill"></i> Editar</a>
                        <a class="bt-eliminar" href="/peoplepro/public/index.php?action=beneficio&method=eliminar&id=<?= $b['id'] ?>" onclick="return confirm('¿Eliminar beneficio?')"><i class="bi bi-trash3-fill"></i> Eliminar</a>
                    </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </main>
<?php include __DIR__ . '/../layout/footer.php'; ?>
