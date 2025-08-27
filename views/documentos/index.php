<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<?php $titulo = "Gestión de Documentos"; ?>
<?php include __DIR__ . '/../layout/header.php'; ?>
    <h2 class="titulo-principal">Gestión de Documentos</h2>

    <main class="main-tabla">
        <?php if ($rol === 'usuario'): ?>
            <a class="btn-tabla" href="/peoplepro/public/index.php?action=documento&method=crear">
                <i class="bi bi-upload"></i> Subir Documento
            </a>
        <?php endif; ?>

        <table id="myTable" class="table table-striped nowrap responsive">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Archivo</th>
                    <th>Fecha</th>
                    <?php if ($rol === 'admin'): ?>
                        <th>Usuario</th>
                        <th>Acciones</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($documentos as $doc): ?>
                <tr>
                    <td><?= htmlspecialchars($doc['nombre']) ?></td>
                    <td>
                        <?php if ($rol === 'admin'): ?>
                            <a href="/peoplepro/<?= $doc['archivo'] ?>" download>Descargar</a>
                        <?php else: ?>
                            <?= basename($doc['archivo']) ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $doc['fecha_subida'] ?></td>
                    <?php if ($rol === 'admin'): ?>
                        <td><?= htmlspecialchars($doc['usuario']) ?></td>
                        <td>
                            <a class="bt-eliminar" href="/peoplepro/public/index.php?action=documento&method=eliminar&id=<?= $doc['id'] ?>" onclick="return confirm('¿Eliminar documento?');">
                                <i class="bi bi-trash3-fill"></i> Eliminar
                            </a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </main>
<?php include __DIR__ . '/../layout/footer.php'; ?>
