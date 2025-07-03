<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PeoplePro - Dashboard</title>
    <link rel="stylesheet" href="/peoplepro/public/css/dashboard.css?v=<?= time(); ?>">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            background-color: #A593E0;
        }
    </style>
</head>

<body>
    <main class="main">

        <!-- Bienvenida -->
        <p style="font-size:1.2rem;margin-bottom:20px;">
            👋 Bienvenido, <strong><?= $_SESSION['usuario_nombre'] ?? 'Administrador' ?></strong>
        </p>

        <!-- Tarjetas principales -->
        <h1>Panel de Control</h1>
        <div class="cards">
            <a class="card blue" href="/peoplepro/public/index.php?action=usuario">
                <h3>Usuarios</h3>
                <p>Gestiona todos los usuarios registrados.</p>
            </a>
            <a class="card green" href="/peoplepro/public/index.php?action=beneficio">
                <h3>Beneficios</h3>
                <p>Revisa y asigna beneficios.</p>
            </a>
            <a class="card orange" href="/peoplepro/public/index.php?action=permiso">
                <h3>Permisos</h3>
                <p>Gestiona incapacidades y licencias.</p>
            </a>
            <a class="card red" href="/peoplepro/public/index.php?action=visitante">
                <h3>Visitantes</h3>
                <p>Registra y controla visitas externas.</p>
            </a>
            <a class="card purple" href="/peoplepro/public/index.php?action=capacitacion">
                <h3>Capacitaciones</h3>
                <p>Consulta y crea nuevas capacitaciones.</p>
            </a>
            <a class="card teal" href="/peoplepro/public/index.php?action=horario">
                <h3>Gestión de Horarios</h3>
                <p>Administra y consulta los horarios del personal.</p>
            </a>
        </div>

        <!-- Rejilla de estadísticas dinámicas -->
        <div class="stats-grid" style="margin-top:40px;">

            <pre style="color:white; background:#000; padding:10px;">
<?php var_dump($totalUsuarios); ?>
</pre>


            <div class="stat-card">
                <h2><?= $totalUsuarios ?? 0 ?></h2>
                <p>Usuarios</p>
            </div>

            <div class="stat-card">
                <h2><?= $totalBeneficios ?></h2>
                <p>Beneficios</p>
            </div>
            <div class="stat-card">
                <h2><?= $totalPermisos ?></h2>
                <p>Permisos activos</p>
            </div>
            <div class="stat-card">
                <h2><?= $totalVisitantes ?></h2>
                <p>Visitantes hoy</p>
            </div>
        </div>


        <!-- Gráfica de ejemplo -->
        <div style="background:#fff;border-radius:8px;padding:24px;margin:32px 0;box-shadow:0 2px 8px rgba(44,62,80,0.08);">
            <canvas id="myChart" height="80"></canvas>
        </div>

        <!-- Actividad reciente -->
        <div style="background:#fff;border-radius:8px;padding:24px;margin-bottom:32px;box-shadow:0 2px 8px rgba(44,62,80,0.08);">
            <h3 style="color:#6c5ce7;margin-bottom:16px;">Actividad reciente</h3>
            <ul style="color:#636e72;">
                <li>Nuevo usuario registrado: <strong>Juan Pérez</strong> (hace 2 horas)</li>
                <li>Permiso aprobado para <strong>Ana Gómez</strong> (hace 4 horas)</li>
                <li>Nuevo visitante: <strong>Empresa XYZ</strong> (hoy)</li>
            </ul>
        </div>

    </main>

    <!-- Script para la gráfica -->
    <script>
        const ctx = document.getElementById('myChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie'],
                datasets: [{
                    label: 'Usuarios activos',
                    data: [12, 19, 14, 17, 22],
                    borderColor: '#6c5ce7',
                    backgroundColor: 'rgba(108,92,231,0.1)',
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>

</html>