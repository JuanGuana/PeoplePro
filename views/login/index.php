<h2>Iniciar sesión</h2>

<?php if (isset($error)): ?>
    <p style="color:red"><?= $error ?></p>
<?php endif; ?>

<?php if (isset($mensaje)): ?>
    <p style="color:green"><?= $mensaje ?></p>
<?php endif; ?>

<!-- Formulario de login -->
<form method="POST" action="/peoplepro/public/index.php?action=login">
    <input type="email" name="email" placeholder="Correo" required><br>
    <input type="password" name="password" placeholder="Contraseña" required><br>
    <button type="submit">Entrar</button>
</form>

<!-- Enlace para mostrar formulario de recuperación -->
<p><a href="#" onclick="document.getElementById('form-recuperar').style.display = 'block'; return false;">
    ¿Olvidaste tu contraseña?
</a></p>

<!-- Formulario de recuperación oculto -->
<div id="form-recuperar" style="display:none; margin-top:20px;">
    <h3>Recuperar contraseña</h3>

    <form method="POST" action="/peoplepro/public/index.php?action=login&method=enviarToken">
        <input type="email" name="email" placeholder="Tu correo" required><br>
        <button type="submit">Enviar enlace</button>
    </form>
</div>
