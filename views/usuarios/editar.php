<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$rol = $rol ?? ($_SESSION['usuario_rol'] ?? 'usuario'); // 👈 evita el "Undefined variable $rol"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/peoplepro/public/css/fondo.css">
    <link rel="stylesheet" href="/peoplepro/public/css/formularios.css">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <!-- botstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <!-- icono de la pestaña -->
    <link rel="shortcut icon" href="/peoplepro/public/img/logo.png"/>
    <title>Editar Usuario</title>
</head>
<body>
    <h2>Editar Usuario</h2>
    <?php if ($rol === 'Admin'): ?>
    <form method="post" action="/peoplepro/public/index.php?action=usuario&method=actualizar&id=<?= htmlspecialchars($usuario['id']) ?>" class="formulario-usuario" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
        
        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>

        <label for="telefono">Numero de telefono:</label>
        <input type="tel" id="telefono" name="telefono" value="<?= htmlspecialchars($usuario['telefono']) ?>" >

        <label for="Direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="<?= htmlspecialchars($usuario['direccion']) ?>">
        
        <label for="rol">Rol:</label>
        <select id="rol" name="rol" required class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
            <option value="Admin" <?= $usuario['rol'] === 'Admin' ? 'selected' : '' ?>>Admin</option>
            <option value="Empleado" <?= $usuario['rol'] === 'Empleado' ? 'selected' : '' ?>>Empleado</option>
            <option value="Seguridad" <?= $usuario['rol'] === 'Seguridad' ? 'selected' : '' ?>>Seguridad</option>
        </select>
        
        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required class="form-select form-select-lg
            mb-3" aria-label=".form-select-lg example">
                <option value="activo" <?= $usuario['estado'] === 'activo' ? 'selected' : '' ?>>Activo</option>
                <option value="vacaciones" <?= $usuario['estado'] === 'vacaciones' ? 'selected' : '' ?>>Vacaciones</option>
                <option value="incapacitado" <?= $usuario['estado'] === 'incapacitado' ? 'selected' : '' ?>>Incapacitado</option>
                <option value="suspendido" <?= $usuario['estado'] === 'suspendido' ? 'selected' : '' ?>>Suspendido</option>
        </select>

        <label for="area_id">Área:</label>
        <select id="area_id" name="area_id" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
            <option value="">-- Sin área --</option>
            <?php foreach ($areas as $area): ?>
                <option value="<?= htmlspecialchars($area['id']) ?>" <?= $usuario['area_id'] == $area['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($area['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <a href="/peoplepro/public/index.php?action=usuario" class="btn-volver">Cancelar</a>
        <button type="submit">Guardar cambios</button>
    </form>
    <?php endif; ?>

    <?php if ($rol === 'Empleado'): ?>
    <form method="post" action="/peoplepro/public/index.php?action=usuario&method=actualizar&id=<?= htmlspecialchars($usuario['id']) ?>" class="formulario-usuario" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" readonly>

        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>

        <label for="telefono">Numero de telefono:</label>
        <input type="tel" id="telefono" name="telefono" value="<?= htmlspecialchars($usuario['telefono']) ?>" >

        <label for="Direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="<?= htmlspecialchars($usuario['direccion']) ?>">
            
        <label for="rol">Rol:</label>
        <select id="rol" name="rol" required class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
            <option value="Admin" <?= $usuario['rol'] === 'Admin' ? 'selected' : '' ?>>Admin</option>
            <option value="Empleado" <?= $usuario['rol'] === 'Empleado' ? 'selected' : '' ?>>Empleado</option>
            <option value="Seguridad" <?= $usuario['rol'] === 'Seguridad' ? 'selected' : '' ?>>Seguridad</option>
        </select>
        <input type="hidden" name="rol" value="<?= htmlspecialchars($usuario['rol']) ?>">

        <label for="area_id">Área:</label>
        <select id="area_id" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" disabled>
            <option value="">-- Sin área --</option>
            <?php foreach ($areas as $area): ?>
                <option value="<?= htmlspecialchars($area['id']) ?>" <?= $usuario['area_id'] == $area['id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($area['nombre']) ?>
                </option>
            <?php endforeach; ?>
        </select>
<input type="hidden" name="area_id" value="<?= htmlspecialchars($usuario['area_id']) ?>">

        <a href="/peoplepro/public/index.php?action=dashboard" class="btn-volver">Cancelar</a>
        <button type="submit">Guardar cambios</button>
    </form>
    <?php endif; ?>
</body>
</html>