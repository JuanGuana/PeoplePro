<!DOCTYPE html>
<html lang="es">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <title>Áreas de trabajo</title>
    <link rel="stylesheet" href="/peoplepro/public/css/fondo.css">
    <link rel="stylesheet" href="/peoplepro/public/css/formularios.css">
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <!-- botstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
</head>
<html>
<body>
    <h2>Editar Área</h2>
    <form method="POST" action="/peoplepro/public/index.php?action=area&method=actualizar&id=<?= $area['id'] ?>">
        <input type="hidden" name="id" value="<?= $data['area']['id'] ?>">
        <label class="label">Nombre:</label>
        <input type="text" name="nombre" value="<?= $data['area']['nombre'] ?>" required placeholder="Digita el nombre de área" class="input-nombre input"><br>

        <label class="label">Descripción:</label>
        <textarea name="descripcion" rows="3" placeholder="Digita la descripción de area" class="input-descripcion input"><?= $data['area']['descripcion'] ?></textarea><br>

        <a href="/peoplepro/public/index.php?action=area" class="btn-volver">Cancelar</a>
        <input type="submit" value="Actualizar" class="boton aceptar-btn">
    </form>
</body>
</html>
