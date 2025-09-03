<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Visitante</title>
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
    <h2>Editar Visitante</h2>

    <form action="/peoplepro/public/index.php?action=visitante&method=actualizar" method="POST">

        <input type="hidden" name="id" value="<?= $data['visitante']['id'] ?>">

        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="<?= $data['visitante']['nombre'] ?>" required><br><br>

        <label>Documento:</label><br>
        <input type="text" name="documento" value="<?= $data['visitante']['documento'] ?>" required><br><br>

        <label>Empresa:</label><br>
        <input type="text" name="empresa" value="<?= $data['visitante']['empresa'] ?>"><br><br>

        <label>Fecha y hora de ingreso:</label><br>
        <input type="datetime-local" name="fecha_ingreso" value="<?= date('Y-m-d\TH:i', strtotime($data['visitante']['fecha_ingreso'])) ?>" required><br><br>

        <label>Fecha y hora de salida:</label><br>
        <input type="datetime-local" name="fecha_salida" value="<?= date('Y-m-d\TH:i', strtotime($data['visitante']['fecha_salida'])) ?>"><br><br>

        <label>Motivo:</label><br>
        <textarea name="motivo" rows="3" cols="40"><?= $data['visitante']['motivo'] ?></textarea><br><br>

        <a href="/peoplepro/public/index.php?action=visitante" class="btn-volver">Cancelar</a>
        <button type="submit">Actualizar</button>

    </form>
</body>
</html>
