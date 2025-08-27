<?php $titulo = "Visitantes Externos"; ?>
<?php include __DIR__ . '/../layout/header.php'; ?>
    <h2 class="titulo-principal">Lista de Visitantes Externos</h2>
        <main class="main-tabla">
            <?php if ($rol === 'Seguridad'): ?>
                <a class="btn-tabla" href="/peoplepro/public/index.php?action=visitante&method=crear"><i class="bi bi-person-plus-fill"></i> Registrar nuevo visitante</a>
            <?php endif; ?>
                <table  id="myTable" class="table table-striped nowrap responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Documento</th>
                            <th>Empresa</th>
                            <th>Fecha Ingreso</th>
                            <th>Fecha salida</th>
                            <th>Motivo</th>
                            <?php if ($rol === 'Seguridad'): ?>
                                <th>Acciones</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['visitantes'] as $v): ?>
                            <tr>
                                <td><?= htmlspecialchars($v['id']) ?></td>
                                <td><?= htmlspecialchars($v['nombre']) ?></td>
                                <td><?= htmlspecialchars($v['documento']) ?></td>
                                <td><?= htmlspecialchars($v['empresa']) ?></td>
                                <td><?= htmlspecialchars($v['fecha_ingreso']) ?></td>
                                <td><?= htmlspecialchars($v['fecha_salida']) ?></td>
                                <td><?= htmlspecialchars($v['motivo']) ?></td>
                                <?php if ($rol === 'Seguridad'): ?>
                                    <td>
                                        <a class="bt-editar" href="/peoplepro/public/index.php?action=visitante&method=editar&id=<?= $v['id'] ?>"><i class="bi bi-pencil-fill"></i> Editar</a>
                                        <a class="bt-eliminar" href="/peoplepro/public/index.php?action=visitante&method=eliminar&id=<?= $v['id'] ?>" onclick="return confirm('¿Estás seguro de eliminar?')"><i class="bi bi-trash3-fill"></i> Eliminar</a>
                                    </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        </main>
<?php include __DIR__ . '/../layout/footer.php'; ?>
