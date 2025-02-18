$('#personnelTable tr').click(function (event) {
    if (event.target.type !== 'checkbox') {
        $(':checkbox', this).trigger('click');
    }
});

$('#personnelTable').DataTable( {
    responsive: true,
    destroy: true,
    order: [3, 'asc'],
    language: {
        url: 'https://cdn.datatables.net/plug-ins/2.1.7/i18n/fr-FR.json',
        "paginate": {
            "previous": "<",
            "next": ">",
            "first": "",
            "last": ""
        }
    },
    layout: {
        autoResize: true,
        autoSize: true,
        height: 500,
        width: 1000,
    }

} );
