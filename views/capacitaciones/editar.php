<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Capacitación</title>
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
    <h2>Editar Capacitación</h2>

    <form method="POST" action="/peoplepro/public/index.php?action=capacitacion&method=editar&id=<?= $data['capacitacion']['id'] ?>">
        <label for="nombre">Nombre:</label><br>
        <input type="text" name="nombre" id="nombre" value="<?php echo htmlspecialchars($data['capacitacion']['nombre']); ?>" required><br><br>

        <label for="descripcion">Descripción:</label><br>
        <textarea name="descripcion" id="descripcion" rows="4" required><?php echo htmlspecialchars($data['capacitacion']['descripcion']); ?></textarea><br><br>

        <label for="fecha">Fecha:</label><br>
        <input type="date" name="fecha" id="fecha" value="<?php echo htmlspecialchars($data['capacitacion']['fecha']); ?>" required><br><br>

        <a href="/peoplepro/public/index.php?action=capacitacion" class="btn-volver">Cancelar</a>
        <button type="submit">Actualizar</button>

    </form>
</body>
</html>
