<?php $titulo = "Áreas de trabajo"; ?>
<?php include __DIR__ . '/../layout/header.php'; ?>

<h2 class="titulo-principal">Áreas de trabajo</h2>

<main class="main-tabla">

    <?php if ($rol === 'Admin'): ?>
        <a class="btn-tabla" href="/peoplepro/public/index.php?action=area&method=crear" title="Crear nueva área">
            <i class="bi bi-bookmark-plus-fill"></i> Nueva Área
        </a>
        <?php if (!empty($mensaje)): ?>
    <div style="padding:10px; margin:10px 0; border-radius:5px; background:#f8f9fa; border:1px solid #ccc; color:#333;">
        <?= htmlspecialchars($mensaje) ?>
    </div>
<?php endif; ?>


        <table id="myTable" class="table table-striped nowrap responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['areas'] as $area): ?>
                <tr>
                    <td><?= htmlspecialchars($area['id']) ?></td>
                    <td><?= htmlspecialchars($area['nombre']) ?></td>
                    <td><?= htmlspecialchars($area['descripcion']) ?></td>
                    <td>
                        <a class="bt-editar" href="/peoplepro/public/index.php?action=area&method=editar&id=<?= $area['id'] ?>">
                            <i class="bi bi-pencil-fill"></i> Editar
                        </a>
                        <a class="bt-eliminar" href="/peoplepro/public/index.php?action=area&method=eliminar&id=<?= $area['id'] ?>" onclick="return confirm('¿Eliminar esta área?')">
                            <i class="bi bi-trash3-fill"></i> Eliminar
                        </a>
                        <a class="bt-ver" href="/peoplepro/public/index.php?action=area&method=detalle&id=<?= $area['id'] ?>">
                            <i class="bi bi-eye-fill"></i> Ver más
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
<?php include __DIR__ . '/../layout/footer.php'; ?>
