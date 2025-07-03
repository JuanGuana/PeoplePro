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
                extend: 'colvis',
                text: 'Columnas',
                init: function(api, node, config) {
                }
            }
            ]
        }
    },
});
});
