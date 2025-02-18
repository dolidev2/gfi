$('#agenceTable tr').click(function (event) {
    if (event.target.type !== 'checkbox') {
        $(':checkbox', this).trigger('click');
    }
});

$('#agenceTable').DataTable( {
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
} );
