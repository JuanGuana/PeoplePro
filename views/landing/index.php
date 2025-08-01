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
    <!--<main>
        <section id="home" class="contenedor">
            <div class="contenedor-texto">
                <h1 class="titulo-landing">Centraliza tu gestión humana con <span>PeoplePro</span></h1>
                <p class="parrafo-landing">
                La solución web pensada para empresas con grandes equipos. Administra beneficios, áreas de trabajo, capacitaciones, documentación de empleados y permisos desde un solo lugar.
                </p>
                 <button class="boton-home"><a href="#contacto">Conoce Más</a></button>
            </div>
            <img src="/peoplepro/public/img/perro-home.gif" alt="">
        </section>
        <section id="sobre-nosotros" class="contenedor">
            <img src="/peoplepro/public/img/nosotros.gif" alt=""> 
            <div class="contenedor-texto">
                <h2 class="titulo-landing titulo-nosotros">Sobre Nosotros</h2>
                <div class="contenedor-tarjetas">
                    <p class="parrafo-landing tarjeta">En PeoplePro desarrollamos soluciones tecnológicas para facilitar la gestión del talento humano en empresas con grandes equipos de trabajo.</p>
                    <p class="parrafo-landing tarjeta">Nuestro objetivo es simplificar procesos, optimizar la administración del personal y mejorar la experiencia de recursos humanos.</p>
                </div>
            </div>
        </section>
        <section id="servicios" class="contenedor">
            <div class="contenedor-servicios">
                <h2 class="titulo-landing">Nuestros Servicios</h2>
                <div class="contenedor-tarjetas-servicios"> 
                    
                    <div class="tarjeta1">
                            <h5 class="card-title mt-3">Gestión Documental</h5>
                            <p class="card-text">Organiza y accede fácilmente a la documentación de tus empleados desde cualquier lugar.</p>
                            <img src="/peoplepro/public/img/carpeta.png" alt="carpeta">
                    </div>

                    <div class="tarjeta1">
                            <h5 class="card-title mt-3">Permisos y Vacaciones</h5>
                            <p class="card-text">Administra las ausencias, vacaciones y permisos de tu personal de forma clara y controlada.</p>
                            <img src="/peoplepro/public/img/isla.png" alt="isla">
                    </div>

                    <div class="tarjeta1">
                            <h5 class="card-title mt-3">Anuncios de Capacitación</h5>
                            <p class="card-text">Informa fácilmente sobre nuevas capacitaciones y actualizaciones internas importantes.</p>
                            <img src="/peoplepro/public/img/megafono.png" alt="megafono">
                    </div>

                    <div class="tarjeta1">
                            <h5 class="card-title mt-3">Estructura Organizacional</h5>
                            <p class="card-text">Visualiza las áreas de trabajo y la estructura interna de tu empresa de forma ordenada.</p>
                            <img src="/peoplepro/public/img/grafico.png" alt="grafico">
                    </div>

                </div>
            </div>
        </section>
        <h2 class="titulo-landing">Contáctanos</h2>
        <section id="contacto" class="contenedor-contacto">
                    <div class="fondo-formulario">
                        <img class="img-formulario" src="/peoplepro/public/img/formularioLanding.gif" alt="">
                        <form action="#" method="post" class="formulario-contacto">
                        <div class="input-contacto">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" id="nombre" placeholder="Tu nombre completo">
                        </div>
                        <div class="input-contacto">
                            <label for="correo" class="form-label">Correo:</label>
                            <input type="email" class="form-control" id="correo" placeholder="tunombre@email.com">
                        </div>
                        <div class="input-contacto">
                            <label for="mensaje" class="form-label">Mensaje:</label>
                            <textarea class="form-control" id="mensaje" rows="4" placeholder="Escribe tu mensaje aquí..."></textarea>
                        </div>
                        <button type="submit" class="boton-contacto">Enviar</button>
                        </form>
                    </div>
        </section>
    </main>--> 
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
    <section class="contacto">
        <form action="" method="post" class="formulario-contacto">
            <div class="input-contacto" id="contacto">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" id="nombre" placeholder="Tu nombre completo">
            </div>
            <div class="input-contacto">
                <label for="correo" class="form-label">Correo:</label>
                <input type="email" class="form-control" id="correo" placeholder="Tu correo electrónico">
            </div>
            <div class="input-contacto">
                <label for="mensaje" class="form-label">Mensaje:</label>
                <textarea class="form-control" id="mensaje" rows="4" placeholder="Tu mensaje..."></textarea>
            </div>
            <button type="submit" class="boton-contacto">Enviar</button>
        </form>
        <img src="/peoplepro/public/img/contacto.gif" class="contacto-imagen" alt="Contacto">
    </section>
    <script src="/peoplepro/public/js/landing.js"></script> 
</body>
</html>