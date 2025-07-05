<?php 
// Verificar que existen los datos esperados
$nombre = $data['nombre'] ?? 'Invitado';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/peoplepro/public/css/fondo.css">
    <link rel="stylesheet" href="/peoplepro/public/css/nav.css">
    <!-- icono de la pestaña -->
    <link rel="shortcut icon" href="/peoplepro/public/img/logo.png"/>
</head>
<body>
    <?php include __DIR__ . '/../menu/menu.php'; ?>

    <main>
        <h1 class="tituloBienvenida">¡Bienvenido, <?= htmlspecialchars($nombre) ?>! 👋</h1>
    </main>

    <script src="/peoplepro/public/js/nav.js"></script>
</body>
</html>
