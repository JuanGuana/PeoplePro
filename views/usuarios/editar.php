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
    <form method="post" action="/peoplepro/public/index.php?action=usuario&method=actualizar&id=<?= htmlspecialchars($usuario['id']) ?>" class="formulario-usuario">
        <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">

        <?php if ($rol === 'admin'): ?>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
        <?php endif; ?>
        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>

        <label for="telefono">Numero de telefono:</label>
        <input type="tel" id="telefono" name="telefono" value="<?= htmlspecialchars($usuario['telefono']) ?>" >

        <label for="Direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="<?= htmlspecialchars($usuario['direccion']) ?>">

        <label for="foto_perfil">Foto de perfil:</label>
        <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*">
            
        <?php if ($rol === 'admin'): ?>
            
        <label for="rol">Rol:</label>
        <select id="rol" name="rol" required class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
            <option value="usuario" <?= $usuario['rol'] === 'usuario' ? 'selected' : '' ?>>Usuario</option>
            <option value="admin" <?= $usuario['rol'] === 'admin' ? 'selected' : '' ?>>Admin</option>
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
        <?php endif; ?>
        <a href="/peoplepro/public/index.php?action=usuario" class="btn-volver">Cancelar</a>
        <button type="submit">Guardar cambios</button>
    </form>

</body>
</html>