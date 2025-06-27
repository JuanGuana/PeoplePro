<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Beneficio</title>
    <link rel="stylesheet" href="/peoplepro/public/css/fondo.css">
</head>
<body>
<?php include __DIR__ . '/../menu/menu.php'; ?><br>

<h2 class="titulo-principal">Crear Nuevo Beneficio</h2>

<form action="/peoplepro/public/index.php?action=beneficio&method=guardar" method="POST" style="margin: 20px;">
    <label for="nombre">Nombre:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label for="descripcion">Descripción:</label><br>
    <textarea name="descripcion" rows="3"></textarea><br><br>

    <label for="fecha_inicio">Fecha de inicio:</label><br>
    <input type="date" name="fecha_inicio" required><br><br>

    <label for="fecha_fin">Fecha de fin:</label><br>
    <input type="date" name="fecha_fin" required><br><br>

    <button type="submit">Guardar</button>
    <a href="/peoplepro/public/index.php?action=beneficio">Cancelar</a>
</form>
</body>
</html>
