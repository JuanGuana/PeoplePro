<?php $titulo = "Dashboard"; ?>
<?php include __DIR__ . '/../layout/header.php'; ?>
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
        <?php if ($rol === 'Admin'): ?>
            <div class="container mt-4">
                <!-- Tarjetas rápidas -->
                <div class="row text-center mb-4">
                    <div class="col-md-2">
                        <div class="card shadow p-3">
                            <h6>Visitantes Hoy</h6>
                            <p class="h3"><?= $stats['visitantes_hoy'] ?></p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card shadow p-3">
                            <h6>Semana</h6>
                            <p class="h3"><?= $stats['visitantes_semana'] ?></p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="card shadow p-3">
                            <h6>Mes</h6>
                            <p class="h3"><?= $stats['visitantes_mes'] ?></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow p-3">
                            <h6>Usuarios Activos</h6>
                            <p class="h3"><?= $stats['usuarios_activos'] ?></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card shadow p-3">
                            <h6>Permisos Pendientes</h6>
                            <p class="h3 text-danger"><?= $stats['permisos_pendientes'] ?></p>
                        </div>
                    </div>
                </div>

                <!-- Gráfica empleados por área -->
                <div class="card shadow p-3 mb-4">
                    <h5>👥 Empleados por Área</h5>
                    <canvas id="empleadosPorArea"></canvas>
                </div>
                <!-- Listado de capacitaciones -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="card shadow p-3">
                            <?php if (!empty($capacitaciones)): ?>
                                <ul>
                                    <?php foreach ($capacitaciones as $c): ?>
                                        <li>
                                            <?= htmlspecialchars($c['nombre']) ?> - <?= htmlspecialchars($c['fecha']) ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p>No hay capacitaciones registradas.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Listado de beneficios -->
                    <div class="col-md-6">
                        <div class="card shadow p-3">
                            <h5>🎁 Beneficios</h5>
                            <?php if (!empty($beneficios)): ?>
                                <ul>
                                    <?php foreach ($beneficios as $b): ?>
                                        <li>
                                            <?= htmlspecialchars($b['nombre']) ?> (<?= htmlspecialchars($b['fecha_inicio']) ?> - <?= htmlspecialchars($b['fecha_fin']) ?>)
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <p>No hay beneficios disponibles.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </main>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Tu JS externo -->
    <script src="js/dashboard.js"></script>

    <script>
        // Pasamos los datos desde PHP a JS
        const empleadosPorArea = <?= json_encode($stats['empleados_por_area']) ?>;
        // Llamamos la función de dashboard.js
        renderEmpleadosPorArea(empleadosPorArea);
    </script>
<?php include __DIR__ . '/../layout/footer.php'; ?>