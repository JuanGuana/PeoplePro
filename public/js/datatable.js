$(document).ready( function () {
    $('#myTable').DataTable({
        responsive: true,
        info: false, // ya lo tienes duplicado
        lengthMenu: [10, 25, 50, 100],
        pagingType: "simple", // <- SOLO muestra anterior y siguiente
        language: {
            url: '//cdn.datatables.net/plug-ins/2.3.2/i18n/es-CO.json',
            paginate: {
                previous: '<i class="bi bi-caret-left-fill"></i>',
                next: '<i class="bi bi-caret-right-fill"></i>'
            }
        },
        dom: 'Bfrtip',
        // buttons: ['copy', 'excel', 'pdf', 'print','colvis'],
        buttons: [
            {
                extend: 'copy',
                text: '<i class="bi bi-clipboard"></i>',
                className: 'btn btn-secondary ',
                titleAttr: 'Copiar al portapapeles',
            },
            {
                extend: 'excel',
                text: '<i class="bi bi-filetype-exe"></i>',
                className: 'btn btn-success',
                titleAttr: 'Exportar a Excel',
            },
            {
                extend: 'pdf',
                text: '<i class="bi bi-filetype-pdf"></i>',
                className: 'btn btn-danger',
                titleAttr: 'Exportar a PDF',
            },
            {
                extend: 'print',
                text: '<i class="bi bi-printer"></i>',
                className: 'btn btn-info',
                titleAttr: 'Imprimir',
            },
            {
                extend: 'colvis',
                text: '<i class="bi bi-border-width"></i>',
                className: 'btn btn-warning',
                titleAttr: 'Seleccionar columnas',
            }
        ],
        columnDefs: [
            { responsivePriority: 1, targets: 0 },
            { responsivePriority: 2, targets: -1 }
        ]
    });
});

