<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peoplepro</title>
    <link rel="stylesheet" href="/peoplepro/public/css/landingHeader.css">
    <link rel="stylesheet" href="/peoplepro/public/css/landing.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <!-- icono de la pestaña -->
    <link rel="shortcut icon" href="/peoplepro/public/img/logo.png"/>
</head>
<body>
     <header class="landing-header">
        <button class="menu-hamburguesa">
                <span class="linea"></span>
                <span class="linea"></span>
            </button>
        <p class="logo"><a href="#">peoplepro</a></p>
        <nav class="landing-nav">
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#software">Sobre nosotros</a></li>
                <li><a href="#servicios">Servicios</a></li>
                <li><a href="#contacto">Contáctanos</a></li>
            </ul>
        </nav>
        <a href="/peoplepro/views/login/index.php" class="login">iniciar sesión</a>
    </header>

    <section class="home" id="home">
        <h2 class="home-titulo">Gestionar personas no debería ser complicado</h2>
        <img src="/peoplepro/public/img/perro-home.gif" class="home-imagen" alt="Perro animado">
    </section>

    <section class="introduccion-del-software" id="software">
        <div class="software-contenedor-texto">
            <h2>Herramientas claras para una gestión humana eficiente</h2>
            <p>¿Necesitas tener claridad sobre quién trabaja en qué área? ¿Coordinar horarios, registrar visitantes o informar sobre capacitaciones sin perder el control? Este sistema te permite centralizar toda la información del personal en una sola plataforma, ahorrando tiempo y mejorando la organización del día a día en tu empresa. Úsalo como una herramienta de apoyo para tomar decisiones claras, rápidas y basadas en datos.</p>
        </div>
        <img src="/peoplepro/public/img/informacion.gif" class="informacion-img">
    </section>

    <section class="servicios" id="servicios">
        <div class="recuadro-informativo">
            <h2>Asignación de empleados por áreas</h2>
            <p>Organiza tu talento según su función. Asigna cada empleado al área correspondiente y obtén una visualización clara del equipo en tiempo real, lista para tomar decisiones acertadas.</p>
            <img src="/peoplepro/public/img/areas.gif" alt="">
        </div>
        <div class="recuadro-informativo">
            <h2>Registro de visitantes externos</h2>
            <p>Controla quién entra y sale. Registra visitantes fácilmente, con nombre, motivo y hora de ingreso. Mejora la seguridad y ten todo el historial a la mano cuando lo necesites.</p>
            <img src="/peoplepro/public/img/visitante.gif" alt="">
        </div>
        <div class="recuadro-informativo">
            <h2>Gestión de horarios y capacitaciones</h2>
            <p>Crea y ajusta horarios de trabajo en minutos. Publica anuncios de capacitaciones para todo el equipo o por áreas específicas, y mantén a tu personal siempre informado y alineado.</p>
            <img src="/peoplepro/public/img/time.gif" alt="">
        </div>
    </section>

    <section class="desarrolladores">
        <div class="contenedor-integrantes">
            <h3></h3>
            <img src="" alt="">
        </div>
        <div class="contenedor-integrantes">
            <h3></h3>
            <img src="" alt="">
        </div>
        <div class="contenedor-integrantes">
            <h3></h3>
            <img src="" alt="">
        </div>
    </section>
    <section class="contacto" id="contacto">
        <div class="informacion-contacto">
            <h2 class="contacto-titulo">¿No estás registardo?</h2>
            <p class="contacto-subtitulo">Contáctanos y te ayudaremos a crear tu cuenta</p>
            <p class="label-contacto">correo de contacto:</p>
            <p class="contenido-contacto">peoplepro_info@gmail.com</p>
            <button onclick="copiarTexto('peoplepro_info@gmail.com')" id="copiar_correo" class="copiar-btn">copiar</button>
            <p class="label-contacto">numero de contacto:</p>
            <p class="contenido-contacto" >+57 3594465289</p>
            <button onclick="copiarTexto('3594465289')" id="copiar_numero" class="copiar-btn">copiar</button>
        </div>
        <img src="/peoplepro/public/img/contacto.gif" class="contacto-img" alt="Contacto">
    </section>
    <script src="/peoplepro/public/js/landing.js"></script> 
</body>
</html>