<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/peoplepro/public/css/fondo.css">
    <link rel="stylesheet" href="/peoplepro/public/css/login.css">
    <!-- icono de la pestaña -->
    <link rel="shortcut icon" href="/peoplepro/public/img/logo.png"/>
</head>
<body>
    <div class="login-container">
        <img src="/peoplepro/public/img/logo.png" alt="Logo PeoplePro" class="logo" width="100" height="100">
        <h2>Iniciar sesión</h2>

        <?php if (isset($error)): ?>
            <p class="mensaje-error"><?= $error ?></p>
        <?php endif; ?>

        <?php if (isset($mensaje)): ?>
            <p class="mensaje-ok"><?= $mensaje ?></p>
        <?php endif; ?>
        <?php if (!empty($mensaje)): ?>
    <div style="padding:10px; margin:10px 0; border-radius:5px; background:#f8f9fa; border:1px solid #ccc; color:#333;">
        <?= htmlspecialchars($mensaje) ?>
    </div>
<?php endif; ?>


        <!-- Formulario de login -->
        <form method="POST" action="/peoplepro/public/index.php?action=login">
            <input type="email" name="email" placeholder="Correo" required>
            <input type="password" name="password" placeholder="Contraseña" required>
            <button type="submit">Entrar</button>
        </form>

        <!-- Enlace para mostrar formulario de recuperación -->
        <a href="#" onclick="document.getElementById('form-recuperar').style.display = 'block'; return false;">
            ¿Olvidaste tu contraseña?
        </a>

        <!-- Formulario de recuperación oculto -->
        <div id="form-recuperar" style="display:none;">
            <h3>Recuperar contraseña</h3>
            <form method="POST" action="/peoplepro/public/index.php?action=login&method=enviarToken">
                <input type="email" name="email" placeholder="Tu correo" required>
                <button type="submit">Enviar enlace</button>
            </form>
        </div>
  </div>
</body>
</html>