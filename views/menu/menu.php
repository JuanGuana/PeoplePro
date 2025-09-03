<?php
if (session_status() === PHP_SESSION_NONE) session_start();

$rol = $_SESSION['usuario_rol'] ?? '';
$nombre = $_SESSION['usuario_nombre'] ?? 'Invitado';
$id = $_SESSION['usuario_id'] ?? '';

function nombreCorto($nombreCompleto) {
    $partes = explode(" ", trim($nombreCompleto));
    if (count($partes) >= 2) {
        return $partes[0] . ' ' . $partes[1]; // Nombre + Primer apellido
    }
    return $nombreCompleto;
}
function iniciales($nombreCompleto) {
    $partes = explode(" ", trim($nombreCompleto));
    if (count($partes) >= 2) {
        return strtoupper($partes[0][0] . $partes[1][0]);
    }
    return strtoupper($nombreCompleto[0]);
}

function colorAleatorio() {
    return sprintf("#%06X", mt_rand(0, 0xFFFFFF));
}
$color = colorAleatorio();
// Redirigir si no hay sesión iniciada
if (!$rol) {
    header("Location: /peoplepro/public/index.php?action=login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú</title>
    <link rel="stylesheet" href="/peoplepro/public/css/nav.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css">
</head>
<body>

<header class="header">
    <div class="izquierda">
        <!-- Botón hamburguesa -->
        <button class="menu-hamburguesa" onclick="toggleMenu()">
            <span class="linea"></span>
            <span class="linea"></span>
            <span class="linea"></span>
        </button>
        <div id="logo"></div> 
    </div>

    <!-- Cerrar sesión -->
    <div class="derecha">
        <p><?= htmlspecialchars(nombreCorto($nombre)) ?></p>
        <div class="iniciales-contenedor" style="background-color:<?= $color ?>">
            <p class="iniciales"><?= htmlspecialchars(iniciales($nombre)) ?></p>
        </div>

    </div>
</header>

<!-- Menú desplegable -->
<nav class="nav-desplegable" id="nav-desplegable">
    <ul class="nav-lista">
        <li class="first-li"><a href="/peoplepro/public/index.php?action=dashboard">Inicio</a></li>
        <?php if ($rol === 'Admin'): ?>
            <li><a href="/peoplepro/public/index.php?action=usuario">Empleados</a></li>
            <li><a href="/peoplepro/public/index.php?action=permiso">Permisos</a></li>
            <li><a href="/peoplepro/public/index.php?action=beneficio">Beneficios</a></li>
            <li><a href="/peoplepro/public/index.php?action=visitante">Visitantes Externos</a></li>
            <li><a href="/peoplepro/public/index.php?action=documento">Documentos</a></li>
            <li><a href="/peoplepro/public/index.php?action=capacitacion">Capacitaciones</a></li>
            <li><a href="/peoplepro/public/index.php?action=horario">Horarios</a></li>
            <li><a href="/peoplepro/public/index.php?action=area">Áreas</a></li>
            <hr>
            <div class="contenedor-acciones-rapidas">
                <a href="/peoplepro/public/index.php?action=logout" class="cerrar-sesion"> <i class="bi bi-box-arrow-left"></i>  Cerrar sesión</a>
                <a href="/peoplepro/public/index.php?action=usuario&method=editar&id=<?= $_SESSION['usuario_id'] ?? '' ?>" class="cerrar-sesion"><i class="bi bi-gear-fill"></i> Configuración</a>
            </div>
            <hr>
        <?php elseif ($rol === 'Empleado'): ?>
            <li><a href="/peoplepro/public/index.php?action=horario">Mis Horarios</a></li>
            <li><a href="/peoplepro/public/index.php?action=permiso">Mis Permisos</a></li>
            <li><a href="/peoplepro/public/index.php?action=capacitacion">Capacitaciones</a></li>
            <li><a href="/peoplepro/public/index.php?action=documento">Documentos</a></li>
            <li><a href="/peoplepro/public/index.php?action=beneficio">Beneficios</a></li>
            <li><a href="/peoplepro/public/index.php?action=area">Áreas</a></li>
            <hr>
            <div class="contenedor-acciones-rapidas">
                <a href="/peoplepro/public/index.php?action=logout" class="cerrar-sesion"> <i class="bi bi-box-arrow-left"></i>  Cerrar sesión</a>
               <a href="/peoplepro/public/index.php?action=usuario&method=editar&id=<?= $_SESSION['usuario_id'] ?? '' ?>" class="cerrar-sesion"><i class="bi bi-gear-fill"></i> Configuración</a>
            </div>
            <hr>
        <?php elseif ($rol === 'Seguridad'): ?>
            <li><a href="/peoplepro/public/index.php?action=visitante">Visitantes Externos</a></li>
            <li><a href="/peoplepro/public/index.php?action=horario">Mis Horarios</a></li>
            <li><a href="/peoplepro/public/index.php?action=permiso">Mis Permisos</a></li>
            <li><a href="/peoplepro/public/index.php?action=documento">Documentos</a></li>
            <li><a href="/peoplepro/public/index.php?action=beneficio">Beneficios</a></li>
            <li><a href="/peoplepro/public/index.php?action=area">Áreas</a></li>
            <hr>
            <div class="contenedor-acciones-rapidas">
                <a href="/peoplepro/public/index.php?action=logout" class="cerrar-sesion"> <i class="bi bi-box-arrow-left"></i>  Cerrar sesión</a>
               <a href="/peoplepro/public/index.php?action=usuario&method=editar&id=<?= $_SESSION['usuario_id'] ?? '' ?>" class="cerrar-sesion"><i class="bi bi-gear-fill"></i> Configuración</a>
            </div>
            <hr>
        <?php endif; ?>
    </ul>
</nav>

<!-- Script para mostrar/ocultar menú -->
<script>
    function toggleMenu() {
        const menu = document.getElementById('nav-desplegable');
        menu.classList.toggle('activo');
    }
</script>

</body>
</html>
