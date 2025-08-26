<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Visitantes Externos</title>
    <link rel="stylesheet" href="/peoplepro/public/css/fondo.css">
    <link rel="stylesheet" href="/peoplepro/public/css/nav.css">
    <link rel="stylesheet" href="/peoplepro/public/css/tablas.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap5.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.3/css/buttons.dataTables.css">
    <!-- datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/peoplepro/public/css/fondo.css">
    <link rel="stylesheet" href="/peoplepro/public/css/nav.css">
    <link rel="stylesheet" href="/peoplepro/public/css/usuario.css">
    <link rel="stylesheet" href="/peoplepro/public/css/tablas.css">
  <!-- icono de la pestaña -->
    <link rel="shortcut icon" href="/peoplepro/public/img/logo.png"/>
</head>
<body>
    <?php include __DIR__ . '/../menu/menu.php'; ?><br>
    <h2 class="titulo-principal">Lista de Visitantes Externos</h2>
        <main class="main-tabla">
            <a class="btn-tabla" href="/peoplepro/public/index.php?action=visitante&method=crear"><i class="bi bi-person-plus-fill"></i> Registrar nuevo visitante</a>
                <table  id="myTable" class="table table-striped nowrap responsive">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Documento</th>
                            <th>Empresa</th>
                            <th>Fecha Ingreso</th>
                            <th>Motivo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['visitantes'] as $v): ?>
                            <tr>
                                <td><?= htmlspecialchars($v['id']) ?></td>
                                <td><?= htmlspecialchars($v['nombre']) ?></td>
                                <td><?= htmlspecialchars($v['documento']) ?></td>
                                <td><?= htmlspecialchars($v['empresa']) ?></td>
                                <td><?= htmlspecialchars($v['fecha_ingreso']) ?></td>
                                <td><?= htmlspecialchars($v['motivo']) ?></td>
                                <td>
                                    <a class="bt-editar" href="/peoplepro/public/index.php?action=visitante&method=editar&id=<?= $v['id'] ?>"><i class="bi bi-pencil-fill"></i> Editar</a>
                                    <a class="bt-eliminar" href="/peoplepro/public/index.php?action=visitante&method=eliminar&id=<?= $v['id'] ?>" onclick="return confirm('¿Estás seguro de eliminar?')"><i class="bi bi-trash3-fill"></i> Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
        </main>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <!-- DataTables y Extensiones -->
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.4/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/3.0.4/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.3/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.4/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.4/js/buttons.bootstrap5.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.4/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.4/js/buttons.colVis.min.js"></script>
    <!-- Bootstrap JS (uno solo es suficiente) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Tu código JS -->
    <script src="/peoplepro/public/js/datatable.js"></script>
    <script src="/peoplepro/public/js/nav.js"></script>
</body>
</html>
