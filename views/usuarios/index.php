<?php $titulo = "Usuarios"; ?>
<?php include __DIR__ . '/../layout/header.php'; ?>
    
        <h2 class="titulo-principal">Crear nuevo usuario</h2>

    <form method="POST" action="/peoplepro/public/index.php?action=usuario&method=crear" class="formulario-usuario">
        <input type="text" id="nombre" name="nombre" placeholder="Nombre completo" required>

        <input type="email" id="email" name="email" placeholder="correo@ejemplo.com" required>

        <input type="password" id="password" name="password" placeholder="Contraseña segura" required minlength="6">

        <input type="tel" id="telefono" name="telefono" placeholder="Numero de Telefono" require minlength="10">

        <input type="text" id="direccion" name="direccion" placeholder="Direccion" require>

        <select id="rol" name="rol" required>
            <option value="">Selecciona un rol</option>
            <option value="Admin">Admin</option>
            <option value="Empleado" selected>Empleado</option>
            <option value="Seguridad">Seguridad</option>
        </select>


        <select id="area_id" name="area_id" required>
            <option value="">Selecciona un área</option>
            <?php foreach ($areas as $area): ?>
                <option value="<?= htmlspecialchars($area['id']) ?>">
                    <?= htmlspecialchars($area['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        
        <button type="submit">Crear usuario <i class="bi bi-person-plus-fill"></i></button>
    </form>

<br>

    <main class="main-usuario">
        <table id="myTable" class="table table-striped nowrap responsive">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Rol</th>
                    <th>Área</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['usuarios'])): ?>
                    <?php foreach ($data['usuarios'] as $usuario): ?>
                        <tr>
                            <td><?= htmlspecialchars($usuario['id']) ?></td>
                            <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                            <td><?= htmlspecialchars($usuario['email']) ?></td>
                            <td><?= htmlspecialchars($usuario['rol']) ?></td>
                            <td><?= htmlspecialchars($usuario['nombre_area'] ?? 'Sin asignar') ?></td>
                            <td>
                                <a class="bt-editar" title="Editar" href="/peoplepro/public/index.php?action=usuario&method=editar&id=<?= $usuario['id'] ?>">
                                    <i class="bi bi-pencil-fill"></i> Editar
                                </a>
                                <a class="bt-eliminar" title="Eliminar" href="/peoplepro/public/index.php?action=usuario&method=eliminar&id=<?= $usuario['id'] ?>" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">
                                    <i class="bi bi-trash3-fill"></i> Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="6">No hay usuarios registrados.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
<?php include __DIR__ . '/../layout/footer.php'; ?>