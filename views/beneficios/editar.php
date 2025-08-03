<?php $b = $beneficio; ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Beneficio</title>
    <link rel="stylesheet" href="/peoplepro/public/css/fondo.css">
</head>
4er5<body>
<?php include __DIR__ . '/../menu/menu.php'; ?><br>

<h2 class="titulo-principal">Editar Beneficio</h2>

<form action="/peoplepro/public/index.php?action=beneficio&method=actualizar&id=<?= $b['id'] ?>" method="POST" style="margin: 20px;">
    <label for="nombre">Nombre:</label><br>
    <input type="text" name="nombre" value="<?= htmlspecialchars($b['nombre']) ?>" required><br><br>

    <label for="descripcion">Descripción:</label><br>
    <textarea name="descripcion" rows="3"><?= htmlspecialchars($b['descripcion']) ?></textarea><br><br>

    <label for="fecha_inicio">Fecha de inicio:</label><br>
    <input type="date" name="fecha_inicio" value="<?= $b['fecha_inicio'] ?>" required><br><br>

    <label for="fecha_fin">Fecha de fin:</label><br>
    <input type="date" name="fecha_fin" value="<?= $b['fecha_fin'] ?>" required><br><br>

    <button type="submit">Actualizar</button>
    <a href="/peoplepro/public/index.php?action=beneficio">Cancelar</a>
</form>
</body>
</html>
