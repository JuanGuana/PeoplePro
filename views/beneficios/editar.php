<?php $b = $beneficio; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Beneficio</title>
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

    <h2 class="titulo-principal">Editar Beneficio</h2>

    <form action="/peoplepro/public/index.php?action=beneficio&method=editar&id=<?= $b['id'] ?>" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre:</label><br>
        <input type="text" name="nombre" value="<?= htmlspecialchars($b['nombre']) ?>" required><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea name="descripcion" rows="3"><?= htmlspecialchars($b['descripcion']) ?></textarea><br><br>

        <label for="fecha_inicio">Fecha de inicio:</label><br>
        <input type="date" name="fecha_inicio" value="<?= $b['fecha_inicio'] ?>" required><br><br>

        <label for="fecha_fin">Fecha de fin:</label><br>
        <input type="date" name="fecha_fin" value="<?= $b['fecha_fin'] ?>" required><br><br>

        <?php if (!empty($data['beneficios']['imagen'])): ?>
            <label>Imagen actual:</label><br>
            <img src="<?= htmlspecialchars($b['imagen']) ?>" alt="Imagen actual" style="max-width: 200px;"><br><br>
        <?php endif; ?>

        <label for="imagen">Cambiar imagen (opcional):</label><br>
        <input type="file" name="imagen" accept="image/*"><br><br>

        <a href="/peoplepro/public/index.php?action=beneficio" class="btn-volver">Cancelar</a>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>
