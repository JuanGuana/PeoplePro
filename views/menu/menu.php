<?php
if (session_status() === PHP_SESSION_NONE) session_start();
$rol = $_SESSION['usuario_rol'] ?? '';
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

    <!-- Buscador -->
    <form action="#" class="buscador">  
        <input type="text" placeholder="Buscar..." class="input-buscador">
        <button type="submit" class="buscador-icono"><i class="bi bi-search"></i></button>
    </form>

    <!-- Cerrar sesión -->
    <div class="derecha">
    </div>
</header>

<!-- Menú desplegable -->
<nav class="nav-desplegable" id="nav-desplegable">
    <ul class="nav-lista">
        <li class="first-li"><a href="/peoplepro/public/index.php?action=dashboard">Inicio</a></li>
        <?php if ($rol === 'admin'): ?>
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
                <a href="/peoplepro/public/index.php?action=logout" class="cerrar-sesion"> <i class="bi bi-gear-fill"></i>  Configuración</a>
            </div>
            <hr>
        <?php elseif ($rol === 'usuario'): ?>
            <li><a href="/peoplepro/public/index.php?action=horario">Mis Horarios</a></li>
            <li><a href="/peoplepro/public/index.php?action=permiso">Mis Permisos</a></li>
            <li><a href="/peoplepro/public/index.php?action=capacitacion">Capacitaciones</a></li>
            <li><a href="/peoplepro/public/index.php?action=documento">Documentos</a></li>
            <li><a href="/peoplepro/public/index.php?action=beneficio">Beneficios</a></li>
            <li><a href="/peoplepro/public/index.php?action=area">Áreas</a></li>
            <hr>
            <div class="contenedor-acciones-rapidas">
                <a href="/peoplepro/public/index.php?action=logout" class="cerrar-sesion"> <i class="bi bi-box-arrow-left"></i>  Cerrar sesión</a>
                <a href="/peoplepro/public/index.php?action=logout" class="cerrar-sesion"> <i class="bi bi-gear-fill"></i>  Configuración</a>
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
