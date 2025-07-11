$(document).ready( function () {
    $('#myTable').DataTable({
        responsive: true,
        info: false,
        language: {
        url: '//cdn.datatables.net/plug-ins/2.3.2/i18n/es-CO.json',
        },
        columnDefs: [
        { responsivePriority: 1, targets: 0 },
        { responsivePriority: 2, targets: -1 }
    ],
    layout: {
    topStart: {
        buttons: [
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
        ]
    }
}

});
});
