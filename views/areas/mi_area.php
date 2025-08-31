<?php
$titulo = "Mi Área de Trabajo";
include __DIR__ . '/../layout/header.php';
?>

    <h2 class="titulo-principal">Mi Área: <?= htmlspecialchars($area['nombre']) ?></h2>
    <p class="subtitulo-principal"><?= htmlspecialchars($area['descripcion']) ?></p>
    <main class="main-tabla">
        <?php if (!empty($usuarios)): ?>
            <table id="myTable" class="table table-striped nowrap responsive">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Teléfono</th>
                        <th>Dirección</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $u): ?>
                        <tr>
                            <td><?= htmlspecialchars($u['nombre']) ?></td>
                            <td><?= htmlspecialchars($u['email']) ?></td>
                            <td><?= htmlspecialchars($u['rol']) ?></td>
                            <td><?= htmlspecialchars($u['telefono'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($u['direccion'] ?? '-') ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No hay integrantes en esta área.</p>
        <?php endif; ?>
    </main>

<?php include __DIR__ . '/../layout/footer.php'; ?>
