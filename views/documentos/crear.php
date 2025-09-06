<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Subir Documento</title>
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
    <h2 class="titulo-principal">Subir Documento</h2>

    <form action="/peoplepro/public/index.php?action=documento&method=guardar" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre del documento:</label><br>
        <input type="text" name="nombre" placeholder="Nombre del documento" required><br><br>

        <label for="archivo">Seleccionar archivo:</label><br>
        <input type="file" name="archivo" required><br><br>
        
        <a href="/peoplepro/public/index.php?action=documento" class="btn-volver">Cancelar</a>
        <button type="submit">Subir</button>
    </form>
</body>
</html>
