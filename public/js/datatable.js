$(document).ready(function () {
    let botones = [];
    let opcionesExtra = {};

    if (window.userRole === 'Admin') {
        // Botones solo para admin
        botones = [
            {
                extend: 'copy',
                className: 'btn-copy btn',
                text: '<i class="bi bi-clipboard-check"></i> Copiar',
            },
            {
                extend: 'excel',
                className: 'btn-excel btn',
                text: '<i class="bi bi-filetype-exe"></i> Excel',
            },
            {
                extend: 'pdf',
                className: 'btn-pdf btn',
                text: '<i class="bi bi-filetype-pdf"></i> PDF',
            },
            {
                extend: 'colvis',
                className: 'btn-colvis btn',
                text: '<i class="bi bi-sort-alpha-down"></i> Filtrar columnas',
            }
        ];

        opcionesExtra = {
            searching: true,
            paging: true
        };

    } else {
        // Empleado: sin botones, sin buscador y sin paginación
        opcionesExtra = {
            searching: false,
            paging: false
        };
    }

    // Inicializamos DataTable
    $('#myTable').DataTable({
        responsive: true,
        info: false,
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.3.2/i18n/es-ES.json'
        },
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ],
        layout: {
            topStart: {
                buttons: botones
            }
        },
        ...opcionesExtra // se agregan las opciones dinámicamente
    });
});


