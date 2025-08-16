<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
</head>
<body>
    <h2>Editar Usuario</h2>
    <form method="post" action="/peoplepro/public/index.php?action=usuario&method=actualizarPerfil" enctype="multipart/form-data" class="formulario-usuario">

        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>

        <label for="telefono">Número de teléfono:</label>
        <input type="tel" id="telefono" name="telefono" value="<?= htmlspecialchars($usuario['telefono']) ?>">

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="<?= htmlspecialchars($usuario['direccion']) ?>">

        <label for="foto_perfil">Foto de perfil:</label>
        <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*">

        <a href="/peoplepro/public/index.php?action=usuario" class="btn-volver">Cancelar</a>
        <button type="submit">Guardar cambios</button>
    </form>

</body>
</html>