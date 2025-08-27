<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Documentos</title>
    <link rel="stylesheet" href="/peoplepro/public/css/fondo.css">
    <link rel="stylesheet" href="/peoplepro/public/css/nav.css">
    <link rel="stylesheet" href="/peoplepro/public/css/tablas.css">
    <link rel="shortcut icon" href="/peoplepro/public/img/logo.png"/>
</head>
<body>
<?php include __DIR__ . '/../menu/menu.php'; ?><br>
<h2 class="titulo-principal">Gestión de Documentos</h2>

<main class="main-tabla">
    <?php if ($rol === 'admin' && empty($usuario_filtrado)): ?>
        <div class="card-tabla">
            <h3>Empleados con documentos:</h3><br>
            <table class="tablas">
                <thead>
                    <tr>
                        <th>Nombre</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td>
                                <a class="usuario-link" href="/peoplepro/public/index.php?action=documento&usuario_id=<?= $usuario['id'] ?>">
                                    <?= htmlspecialchars($usuario['nombre']) ?>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>

    <?php if ($rol === 'admin' && !empty($usuario_filtrado)): ?>
        <div class="filtro-usuario">
            <strong>Documentos de:</strong> <?= htmlspecialchars($usuario_filtrado) ?>
            <a href="/peoplepro/public/index.php?action=documento">Ver empleados</a>
            <br><br>
        </div>
        <table class="tablas">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Archivo</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($documentos as $doc): ?>
                <tr>
                    <td><?= htmlspecialchars($doc['nombre']) ?></td>
                    <td>
                        <a href="/peoplepro/<?= $doc['archivo'] ?>" download>Descargar</a>
                    </td>
                    <td><?= $doc['fecha_subida'] ?></td>
                    <td>
                        <a class="bt-eliminar" href="/peoplepro/public/index.php?action=documento&method=eliminar&id=<?= $doc['id'] ?>" onclick="return confirm('¿Eliminar documento?');">
                            <i class="bi bi-trash3-fill"></i> Eliminar
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if ($rol === 'usuario'): ?>
  <div class="card-tabla">
    <a class="btn-tabla" href="/peoplepro/public/index.php?action=documento&method=crear">
      <i class="bi bi-upload"></i> Subir Documento
    </a>
    <br><br>
    <table class="tablas">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Archivo</th>
          <th>Fecha y Hora</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($documentos as $doc): ?>
          <tr>
            <td><?= htmlspecialchars($doc['nombre']) ?></td>
            <td>
              <a href="/peoplepro/<?= $doc['archivo'] ?>" download>Descargar</a>
            </td>
            <td><?= htmlspecialchars($doc['fecha_subida']) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>
</main>
<script src="/peoplepro/public/js/nav.js"></script>
</body>
</html>