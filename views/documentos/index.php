<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<?php $titulo = "Gestión de Documentos"; ?>
<?php include __DIR__ . '/../layout/header.php'; ?>
    <h2 class="titulo-principal">Gestión de Documentos</h2>

    <main class="main-tabla">
        <?php if ($rol === 'Empleado'): ?>
            <a class="btn-tabla" href="/peoplepro/public/index.php?action=documento&method=crear">
                <i class="bi bi-upload"></i> Subir Documento
            </a>
        <?php endif; ?>
        <?php if (!empty($mensaje)): ?>
    <div style="padding:10px; margin:10px 0; border-radius:5px; background:#f8f9fa; border:1px solid #ccc; color:#333;">
        <?= htmlspecialchars($mensaje) ?>
    </div>
<?php endif; ?>


        <table id="myTable" class="table table-striped nowrap responsive">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Archivo</th>
                    <th>Fecha</th>
                    <?php if ($rol === 'Admin'): ?>
                        <th>Usuario</th>
                    <?php endif; ?>
                        <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($documentos as $doc): ?>
                <tr>
                    <td><?= htmlspecialchars($doc['nombre']) ?></td>
                    <td>
                        <?php if ($rol === 'Admin'): ?>
                            <a href="/peoplepro/<?= $doc['archivo'] ?>" download class="btn btn-primary"><i class="bi bi-download"></i> Descargar</a>

                        <?php else: ?>
                            <?= basename($doc['archivo']) ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $doc['fecha_subida'] ?></td>
                    <?php if ($rol === 'Admin'): ?>
                        <td><?= htmlspecialchars($doc['usuario']) ?></td>
                    <?php endif; ?>
                        <td>
                            <a class="bt-eliminar" href="/peoplepro/public/index.php?action=documento&method=eliminar&id=<?= $doc['id'] ?>" onclick="return confirm('¿Eliminar documento?');">
                                <i class="bi bi-trash3-fill"></i> Eliminar
                            </a>
                        </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </main>
<?php include __DIR__ . '/../layout/footer.php'; ?>
