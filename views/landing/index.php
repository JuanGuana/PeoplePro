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
                <li><a href="#">Home</a></li>
                <li><a href="#sobre-nosotros">Sobre nosotros</a></li>
                <li><a href="#servicios">Servicios</a></li>
                <li><a href="#contacto">Contáctanos</a></li>
            </ul>
        </nav>
        <a href="/peoplepro/views/login/index.php" class="login">iniciar sesión</a>
    </header>
    <main>
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
    </main>
    <script src="/peoplepro/public/js/landing.js"></script>
</body>
</html>