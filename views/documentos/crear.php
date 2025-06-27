<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir Documento</title>
    <link rel="stylesheet" href="/peoplepro/public/css/fondo.css">
</head>
<body>
<?php include __DIR__ . '/../menu/menu.php'; ?><br>
<h2 class="titulo-principal">Subir Documento</h2>

<form action="/peoplepro/public/index.php?action=documento&method=guardar" method="POST" enctype="multipart/form-data" style="margin: 20px;">
    <label for="nombre">Nombre del documento:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label for="archivo">Seleccionar archivo:</label><br>
    <input type="file" name="archivo" required><br><br>

    <button type="submit">Subir</button>
    <a href="/peoplepro/public/index.php?action=documento">Cancelar</a>
</form>
</body>
</html>
