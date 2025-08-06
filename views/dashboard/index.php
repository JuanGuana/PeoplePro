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
    <link rel="stylesheet" href="/peoplepro/public/css/dashboard.css">
    <!-- icono de la pestaña -->
    <link rel="shortcut icon" href="/peoplepro/public/img/logo.png"/>
</head>
<body>
    <?php include __DIR__ . '/../menu/menu.php'; ?>
    <h1 class="tituloBienvenida">¡Bienvenido, <?= htmlspecialchars($nombre) ?>! 👋</h1>
    <main class="main">
    
        <?php if ($rol === 'usuario'): ?>
            <?php if (!empty($beneficios)): ?>
                <h2>Beneficios Disponibles</h2>
                <div class="beneficios">
                    <?php foreach ($beneficios as $b): ?>
                        <div class="beneficio-card">
                            <img src="/peoplepro/<?= htmlspecialchars($b['imagen']) ?>" alt="Imagen de beneficio" width="200">
                            <p><?= htmlspecialchars($b['descripcion']) ?></p>
                            <small>Desde: <?= $b['fecha_inicio'] ?> Hasta: <?= $b['fecha_fin'] ?></small>
                            <a href="/peoplepro/public/index.php?action=beneficio">Ver más</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        <?php if (!empty($capacitaciones)): ?>
            <h2>Capacitaciones Recientes</h2>
                <div class="capacitaciones">
                    <?php foreach ($capacitaciones as $cap): ?>
                        <div class="cap-card">
                            <img src="/peoplepro/<?= htmlspecialchars($cap['imagen_capacitacion']) ?>" alt="Imagen de capacitación" width="200">
                            <h3><?= htmlspecialchars($cap['nombre']) ?></h3>
                            <p><?= htmlspecialchars($cap['descripcion']) ?></p>
                            <small><?= htmlspecialchars($cap['fecha']) ?></small>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>No hay capacitaciones registradas.</p>
            <?php endif; ?>
        <?php endif; ?>
    </main>

    <script src="/peoplepro/public/js/nav.js"></script>
</body>
</html>
