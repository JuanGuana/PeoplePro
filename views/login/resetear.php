<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Restablecer Contraseña</title>
    <link rel="stylesheet" href="/peoplepro/public/css/estilos.css">
</head>
<body>
    <div class="container">
        <h2> Restablecer Contraseña</h2>

        <form action="/peoplepro/public/index.php?action=login&method=actualizarPassword" method="POST">
            <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

            <div>
                <label for="password">Nueva contraseña:</label><br>
                <input type="password" name="password" id="password" required>
            </div>

            <br>

            <button type="submit">Actualizar Contraseña</button>
        </form>
    </div>
</body>
</html>
