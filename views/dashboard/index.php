
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
    <main class="main">
    
        <?php if ($rol === 'Empleado'): ?>
            <?php if (!empty($beneficios)): ?>
                <h2 class="beficio-titulo">Tus Beneficios Disponibles</h2>
                <a href="/peoplepro/public/index.php?action=beneficio" class="ver-mas">Ver más</a>
                <div class="beneficios">
                    <?php foreach ($beneficios as $b): ?>
                        <div class="beneficio-card">
                            <img src="<?= htmlspecialchars($b['imagen']) ?>" alt="Imagen de beneficio" >
                            <small>Desde: <?= $b['fecha_inicio'] ?> Hasta: <?= $b['fecha_fin'] ?></small>
                            <p><?= htmlspecialchars($b['descripcion']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($capacitaciones)): ?>
                <h2 class="beficio-titulo">Próximas capacitaciones</h2>
                <a href="/peoplepro/public/index.php?action=capacitacion" class="ver-mas">Ver más</a>
                <div class="beneficios">
                    <?php foreach ($capacitaciones as $c): ?>
                        <div class="capacitacion-card">
                            <img src="/peoplepro/<?= htmlspecialchars($c['imagen_capacitacion']) ?>" alt="Imagen de capacitación">
                            <small>Fecha: <?= $c['fecha'] ?></small>
                            <p><?= htmlspecialchars($c['descripcion']) ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </main>
    <script src="/peoplepro/public/js/dashboard.js"></script>
    <script src="/peoplepro/public/js/nav.js"></script>
</body>
</html>
